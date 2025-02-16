<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;

class Image
{
    private \GdImage $image;

    /**
     * @throws ImageNotCreatedException
     */
    public function __construct(int $width, int $height)
    {
        $this->image = imagecreatetruecolor($width, $height);

        if (!$this->image) {
            throw new ImageNotCreatedException();
        }
    }

    public function colorAllocate($red, $green, $blue): int
    {
        return imagecolorallocate($this->image, $red, $green, $blue);
    }

    public function fillRectangle(int $x1, int $y1, int $x2, int $y2, int $color): bool
    {
        return imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $color);
    }

    public function toGif(?string $filename = null): bool
    {
        return imagegif($this->image, $filename);
    }

    public function toJpeg(?string $filename = null, int $quality = 80): bool
    {
        return imagejpeg($this->image, $filename, $quality);
    }

    public function toPng(?string $filename = null, int $quality = 80): bool
    {
        return imagepng($this->image, $filename, $quality);
    }
}
