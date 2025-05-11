<?php

namespace Tests\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\PdfDocumentPainter;

class PdfDocumentPainterTest extends BasePainterTestCase
{
    public static function provideDataForPaint(): \Generator
    {
        yield [new Matrix(array_fill(0, 10, array_fill(0, 10, 0))), 0];
        yield [new Matrix(array_fill(0, 10, [0, 0, 1, 0, 0, 1, 1, 0, 0, 1])), 40];
        yield [new Matrix(array_fill(0, 10, array_fill(0, 10, 1))), 100];
    }

    protected function getPainterClass(): string
    {
        return PdfDocumentPainter::class;
    }
}
