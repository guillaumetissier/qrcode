<?php

namespace Tests\MatrixRenderer\Painter;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;
use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\ImagePainter;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\Image;

class ImagePainterTest extends TestCase
{
    private ImagePainter $imagePainter;

    public function setUp(): void
    {
        $this->imagePainter = new ImagePainter();
    }

    /**
     * @throws Exception
     * @throws NoDataException
     * @dataProvider provideDataForPaint
     */
    public function testPaint(array $data, int $expectedCallCounts): void
    {
        $image = $this->createMock(Image::class);
        $image->expects($this->exactly($expectedCallCounts))->method('paintRectangle');
        $this->imagePainter->paint($image, $data, 10);
    }

    public static function provideDataForPaint(): array
    {
        return [
            [
                array_fill(0, 10, array_fill(0, 10, 0)),
                1
            ],
            [
                array_fill(0, 10, [0, 0, 0, 0, 0, 1, 1, 1, 1, 1]),
                51
            ],
            [
                array_fill(0, 10, array_fill(0, 10, 1)),
                101
            ],
        ];
    }
}
