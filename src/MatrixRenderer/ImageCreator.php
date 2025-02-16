<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;

class ImageCreator
{
    /**
     * @throws ImageNotCreatedException
     */
    public function create(array $data, int $scale): Image
    {
        $size = count($data);
        $imageSize = $size * $scale;
        $image = new Image($imageSize, $imageSize);

        $white = $image->colorAllocate(255, 255, 255);
        $black = $image->colorAllocate(0, 0, 0);

        $image->fillRectangle(0, 0, $imageSize, $imageSize, $white);

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($data[$y][$x]) {
                    $image->fillRectangle(
                        $x * $scale,
                        $y * $scale,
                        ($x + 1) * $scale - 1,
                        ($y + 1) * $scale - 1,
                        $black
                    );
                }
            }
        }

        return $image;
    }
}
