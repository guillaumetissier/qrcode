<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Painter;

use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\Image;
use ThePhpGuild\QrCode\MatrixRenderer\Canvas\CanvasInterface;

class ImagePainter implements PainterInterface
{
    /**
     * @throws NoDataException
     */
    public function paint(CanvasInterface $canvas, array $data, int $scale): void
    {
        if (0 === ($size = count($data))) {
            throw new NoDataException();
        }

        $imageSize = $size * $scale;

        $canvas->paintRectangle(Image::WHITE, 0, 0, $imageSize, $imageSize);

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($data[$y][$x]) {
                    $canvas->paintRectangle(Image::BLACK,
                        $x * $scale,
                        $y * $scale,
                        ($x + 1) * $scale - 1,
                        ($y + 1) * $scale - 1
                    );
                }
            }
        }
    }
}
