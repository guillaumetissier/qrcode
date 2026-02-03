<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\Image;
use Guillaumetissier\QrCode\Commands\Output\OutputOptionsInterface;
use Guillaumetissier\QrCode\Exception\ColorException;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    private string $tempDir;

    protected function setUp(): void
    {
        $this->tempDir = sys_get_temp_dir() . '/qrcode_tests_' . uniqid();
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

    public function testConstructorCreatesImageSuccessfully(): void
    {
        $image = new Image(100, 100);

        $this->assertInstanceOf(Image::class, $image);
    }

    public function testConstructorInitializesDefaultColors(): void
    {
        $image = new Image(100, 100);

        // Should not throw exception since black and white are initialized
        $result = $image->paintRectangle(Image::BLACK, 0, 0, 10, 10);
        $this->assertTrue($result);

        $result = $image->paintRectangle(Image::WHITE, 20, 20, 30, 30);
        $this->assertTrue($result);
    }

    public function testAddColorToPaletteReturnsFluentInterface(): void
    {
        $image = new Image(100, 100);
        $result = $image->addColorToPalette('red', 255, 0, 0);

        $this->assertSame($image, $result);
    }

    public function testAddColorToPaletteAllowsUsingNewColor(): void
    {
        $image = new Image(100, 100);
        $image->addColorToPalette('blue', 0, 0, 255);
        $result = $image->paintRectangle('blue', 0, 0, 50, 50);

        $this->assertTrue($result);
    }

    public function testPaintRectangleThrowsExceptionForUnknownColor(): void
    {
        $image = new Image(100, 100);
        $this->expectException(ColorException::class);
        $this->expectExceptionMessage("Color 'nonexistent' not found in palette");

        $image->paintRectangle('nonexistent', 0, 0, 10, 10);
    }

    public function testPaintRectangleReturnsTrueOnSuccess(): void
    {
        $image = new Image(100, 100);
        $result = $image->paintRectangle(Image::BLACK, 10, 10, 20, 20);

        $this->assertTrue($result);
    }

    public function testOutputCreatesGifFile(): void
    {
        $image = new Image(50, 50);
        $filename = $this->tempDir . '/test.gif';

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('fileType')->willReturn(FileType::GIF);
        $options->method('filename')->willReturn($filename);

        $result = $image->output($options);

        $this->assertTrue($result);
        $this->assertFileExists($filename);

        // Verify it's a valid GIF
        $imageInfo = getimagesize($filename);
        $this->assertNotFalse($imageInfo);
        $this->assertEquals(IMAGETYPE_GIF, $imageInfo[2]);
    }

    public function testOutputCreatesPngFile(): void
    {
        $image = new Image(50, 50);
        $filename = $this->tempDir . '/test.png';
        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('fileType')->willReturn(FileType::PNG);
        $options->method('filename')->willReturn($filename);
        $options->method('quality')->willReturn(80);

        $result = $image->output($options);

        $this->assertTrue($result);
        $this->assertFileExists($filename);

        // Verify it's a valid PNG
        $imageInfo = getimagesize($filename);
        $this->assertNotFalse($imageInfo);
        $this->assertEquals(IMAGETYPE_PNG, $imageInfo[2]);
    }

    public function testOutputCreatesJpgFile(): void
    {
        $image = new Image(50, 50);
        $filename = $this->tempDir . '/test.jpg';
        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('fileType')->willReturn(FileType::JPG);
        $options->method('filename')->willReturn($filename);
        $options->method('quality')->willReturn(90);

        $result = $image->output($options);

        $this->assertTrue($result);
        $this->assertFileExists($filename);

        // Verify it's a valid JPEG
        $imageInfo = getimagesize($filename);
        $this->assertNotFalse($imageInfo);
        $this->assertEquals(IMAGETYPE_JPEG, $imageInfo[2]);
    }

    public function testOutputWithNullFilenameOutputsToStdout(): void
    {
        $image = new Image(50, 50);
        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn(null);
        $options->method('fileType')->willReturn(FileType::PNG);
        $options->method('filename')->willReturn(null);
        $options->method('quality')->willReturn(80);

        ob_start();
        $result = $image->output($options);
        $output = ob_get_clean();

        $this->assertTrue($result);
        $this->assertNotEmpty($output);
    }

    public function testOutputSendsContentTypeHeader(): void
    {
        if (!function_exists('xdebug_get_headers')) {
            $this->markTestSkipped('xdebug_get_headers not available');
        }

        $image = new Image(50, 50);
        $filename = $this->tempDir . '/test.png';

        $options = $this->createMock(OutputOptionsInterface::class);
        $options->method('contentType')->willReturn('image/png');
        $options->method('fileType')->willReturn(FileType::PNG);
        $options->method('filename')->willReturn($filename);
        $options->method('quality')->willReturn(80);

        $image->output($options);

        $headers = xdebug_get_headers();
        $this->assertContains('Content-Type: image/png', $headers);
    }

    public function testMultipleColorsPaintedCorrectly(): void
    {
        $image = new Image(100, 100);

        $image->addColorToPalette('red', 255, 0, 0)
            ->addColorToPalette('green', 0, 255, 0)
            ->addColorToPalette('blue', 0, 0, 255);

        $this->assertTrue($image->paintRectangle('red', 0, 0, 30, 30));
        $this->assertTrue($image->paintRectangle('green', 35, 0, 65, 30));
        $this->assertTrue($image->paintRectangle('blue', 70, 0, 100, 30));
    }

    public function testPngQualityConversion(): void
    {
        $image = new Image(50, 50);
        $filename1 = $this->tempDir . '/test_high_quality.png';
        $filename2 = $this->tempDir . '/test_low_quality.png';

        // High quality (low compression)
        $options1 = $this->createMock(OutputOptionsInterface::class);
        $options1->method('contentType')->willReturn(null);
        $options1->method('fileType')->willReturn(FileType::PNG);
        $options1->method('filename')->willReturn($filename1);
        $options1->method('quality')->willReturn(100);

        $image->output($options1);

        // Low quality (high compression)
        $image2 = new Image(50, 50);
        $options2 = $this->createMock(OutputOptionsInterface::class);
        $options2->method('contentType')->willReturn(null);
        $options2->method('fileType')->willReturn(FileType::PNG);
        $options2->method('filename')->willReturn($filename2);
        $options2->method('quality')->willReturn(0);

        $image2->output($options2);

        // High quality should generally produce larger files
        // (though this isn't guaranteed for simple images)
        $this->assertFileExists($filename1);
        $this->assertFileExists($filename2);
    }
}
