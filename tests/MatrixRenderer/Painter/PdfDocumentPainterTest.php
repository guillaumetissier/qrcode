<?php

namespace Tests\MatrixRenderer\Painter;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\PdfDocument;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\PdfDocumentPainter;

class PdfDocumentPainterTest extends TestCase
{
    private PdfDocumentPainter $pdfDocumentPainter;

    public function setUp(): void
    {
        $this->pdfDocumentPainter = new PdfDocumentPainter();
    }

    /**
     * @throws Exception
     * @dataProvider provideDataForPaint
     */
    public function testPaint(array $data, int $expectedCallCounts): void
    {
        $image = $this->createMock(PdfDocument::class);
        $image->expects($this->exactly($expectedCallCounts))->method('paintRectangle');
        $this->pdfDocumentPainter->paint($image, $data, 10);
    }

    public static function provideDataForPaint(): array
    {
        return [
            [
                array_fill(0, 10, array_fill(0, 10, 0)),
                0
            ],
            [
                array_fill(0, 10, [0, 0, 1, 0, 0, 1, 1, 0, 0, 1]),
                40
            ],
            [
                array_fill(0, 10, array_fill(0, 10, 1)),
                100
            ],
        ];
    }
}
