<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use GdImage;

class ImageCreator
{
    public function create(array $data, int $scale): GDImage
    {
        $size = count($data);
        $imageSize = $size * $scale;
        $image = imagecreatetruecolor($imageSize, $imageSize);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, $imageSize, $imageSize, $white);

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                if ($data[$y][$x]) {
                    imagefilledrectangle(
                        $image,
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
