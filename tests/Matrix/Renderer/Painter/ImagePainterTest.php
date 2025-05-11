<?php

namespace Tests\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\ImagePainter;

class ImagePainterTest extends BasePainterTestCase
{
    public static function provideDataForPaint(): \Generator
    {
        yield [new Matrix(array_fill(0, 10, array_fill(0, 10, 0))), 1];
        yield [new Matrix(array_fill(0, 10, [0, 0, 0, 0, 0, 1, 1, 1, 1, 1])), 51];
        yield [new Matrix(array_fill(0, 10, array_fill(0, 10, 1))), 101];
    }

    protected function getPainterClass(): string
    {
        return ImagePainter::class;
    }
}
