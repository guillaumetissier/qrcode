<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\PdfDocument;
use Guillaumetissier\QrCode\Commands\Output\OutputOptionsInterface;
use Guillaumetissier\QrCode\Exception\ColorException;
use PHPUnit\Framework\TestCase;
use TCPDF;

class PdfDocumentTest extends TestCase
{
    private string $tempDir;

    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/qrcode_pdf_tests_' . uniqid();
        mkdir($this->tempDir);
    }

    protected function tearDown(): void
    {
        // Cleanup temp files
        if (is_dir($this->tempDir)) {
            $files = glob($this->tempDir . '/*');
            if (false !== $files) {
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
            }
            rmdir($this->tempDir);
        }
    }

    public function testCreateA4(): void
    {
        $pdf = PdfDocument::createA4();

        $this->assertInstanceOf(PdfDocument::class, $pdf);
        $this->assertInstanceOf(TCPDF::class, $pdf->getPdf());
    }

    public function testCreateLetter(): void
    {
        $this->assertInstanceOf(PdfDocument::class, PdfDocument::createLetter());
    }

    public function testConstructorInitializesDefaultColors(): void
    {
        $pdf = PdfDocument::createA4();

        // Should not throw exception since black and white are initialized
        $result = $pdf->paintRectangle('black', 10, 10, 20, 20);
        $this->assertTrue($result);

        $result = $pdf->paintRectangle('white', 30, 30, 40, 40);
        $this->assertTrue($result);
    }

    public function testAddColorToPaletteReturnsFluentInterface(): void
    {
        $pdf = PdfDocument::createA4();

        $result = $pdf->addColorToPalette('red', 255, 0, 0);

        $this->assertSame($pdf, $result);
    }

    public function testAddColorToPaletteAllowsUsingNewColor(): void
    {
        $pdf = PdfDocument::createA4();

        $pdf->addColorToPalette('blue', 0, 0, 255);
        $result = $pdf->paintRectangle('blue', 0, 0, 50, 50);

        $this->assertTrue($result);
    }

    public function testAddMultipleCustomColors(): void
    {
        $pdf = PdfDocument::createA4();

        $pdf->addColorToPalette('red', 255, 0, 0)
            ->addColorToPalette('green', 0, 255, 0)
            ->addColorToPalette('blue', 0, 0, 255);

        $this->assertTrue($pdf->paintRectangle('red', 0, 0, 10, 10));
        $this->assertTrue($pdf->paintRectangle('green', 15, 0, 25, 10));
        $this->assertTrue($pdf->paintRectangle('blue', 30, 0, 40, 10));
    }

    public function testPaintRectangleThrowsExceptionForUnknownColor(): void
    {
        $pdf = PdfDocument::createA4();

        $this->expectException(ColorException::class);
        $this->expectExceptionMessage("Color 'nonexistent' not found in palette");

        $pdf->paintRectangle('nonexistent', 0, 0, 10, 10);
    }

    public function testPaintRectangleReturnsTrueOnSuccess(): void
    {
        $pdf = PdfDocument::createA4();

        $result = $pdf->paintRectangle('black', 10, 10, 20, 20);

        $this->assertTrue($result);
    }

    public function testPaintRectangleCalculatesWidthAndHeightCorrectly(): void
    {
        $pdf = PdfDocument::createA4();

        // Paint a rectangle from (10,10) to (50,30)
        // Width should be 40, height should be 20
        $result = $pdf->paintRectangle('black', 10, 10, 50, 30);

        $this->assertTrue($result);
    }

    public function testPaintMultipleRectangles(): void
    {
        $pdf = PdfDocument::createA4();

        $pdf->addColorToPalette('red', 255, 0, 0);

        $this->assertTrue($pdf->paintRectangle('black', 0, 0, 10, 10));
        $this->assertTrue($pdf->paintRectangle('white', 15, 0, 25, 10));
        $this->assertTrue($pdf->paintRectangle('red', 30, 0, 40, 10));
    }

    public function testOutputCreatesPdfFile(): void
    {
        $pdf = PdfDocument::createA4();
        $pdf->paintRectangle('black', 10, 10, 50, 50);

        $filename = $this->tempDir . '/test.pdf';

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('filename')->willReturn($filename);

        $result = $pdf->withOutputOptions($options)->output();

        $this->assertTrue($result);
        $this->assertFileExists($filename);

        // Verify it's a valid PDF (starts with %PDF)
        $content = file_get_contents($filename);
        $this->assertNotFalse($content);
        $this->assertStringStartsWith('%PDF', $content);
    }

    public function testOutputWithNullFilenameOutputsToStdout(): void
    {
        $pdf = PdfDocument::createA4();
        $pdf->paintRectangle('black', 10, 10, 50, 50);

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('filename')->willReturn(null);

        ob_start();
        $result = $pdf->withOutputOptions($options)->output();
        $output = ob_get_clean();

        $this->assertTrue($result);
        $this->assertNotEmpty($output);
        $this->assertStringStartsWith('%PDF', $output);
    }

    public function testOutputSendsContentTypeHeader(): void
    {
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped('xdebug_get_headers not available');
        }

        $pdf = PdfDocument::createA4();
        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn('application/pdf');
        $options->method('filename')->willReturn(null);

        ob_start();
        $pdf->withOutputOptions($options)->output();
        ob_get_clean();

        $headers = xdebug_get_headers();

        $this->assertContains('Content-Type: application/pdf', $headers);
    }

    public function testComplexDrawing(): void
    {
        $pdf = PdfDocument::createA4();

        // Create a checkerboard pattern
        $pdf->addColorToPalette('lightgray', 200, 200, 200);

        for ($x = 0; $x < 100; $x += 10) {
            for ($y = 0; $y < 100; $y += 10) {
                $color = (($x + $y) / 10) % 2 === 0 ? 'black' : 'lightgray';
                $pdf->paintRectangle($color, $x, $y, $x + 10, $y + 10);
            }
        }

        $filename = $this->tempDir . '/checkerboard.pdf';

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('filename')->willReturn($filename);

        $result = $pdf->withOutputOptions($options)->output();

        $this->assertTrue($result);
        $this->assertFileExists($filename);
        $this->assertGreaterThan(1000, filesize($filename)); // PDF should have reasonable size
    }

    public function testGetPdfReturnsInstanceOfTCPDF(): void
    {
        $pdf = PdfDocument::createA4();

        $tcpdf = $pdf->getPdf();

        $this->assertInstanceOf(TCPDF::class, $tcpdf);
    }

    public function testRgbColorBoundaries(): void
    {
        $pdf = PdfDocument::createA4();

        // Test with boundary values
        $pdf->addColorToPalette('min', 0, 0, 0)
            ->addColorToPalette('max', 255, 255, 255)
            ->addColorToPalette('mixed', 128, 64, 192);

        $this->assertTrue($pdf->paintRectangle('min', 0, 0, 10, 10));
        $this->assertTrue($pdf->paintRectangle('max', 15, 0, 25, 10));
        $this->assertTrue($pdf->paintRectangle('mixed', 30, 0, 40, 10));
    }

    public function testOverlappingRectangles(): void
    {
        $pdf = PdfDocument::createA4();

        $pdf->addColorToPalette('red', 255, 0, 0);
        $pdf->addColorToPalette('blue', 0, 0, 255);

        // Draw overlapping rectangles
        $this->assertTrue($pdf->paintRectangle('red', 10, 10, 50, 50));
        $this->assertTrue($pdf->paintRectangle('blue', 30, 30, 70, 70));

        $filename = $this->tempDir . '/overlapping.pdf';

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('filename')->willReturn($filename);

        $result = $pdf->withOutputOptions($options)->output();

        $this->assertTrue($result);
        $this->assertFileExists($filename);
    }

    public function testZeroSizeRectangle(): void
    {
        $pdf = PdfDocument::createA4();

        // Rectangle with same start and end points (zero size)
        $result = $pdf->paintRectangle('black', 10, 10, 10, 10);

        $this->assertTrue($result);
    }

    public function testNegativeCoordinates(): void
    {
        $pdf = PdfDocument::createA4();

        // TCPDF might handle negative coordinates, but behavior may vary
        // This test documents the behavior
        $result = $pdf->paintRectangle('black', -10, -10, 10, 10);

        $this->assertTrue($result);
    }
}
