<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

class GifMatrixRenderer extends AbstractMatrixRenderer
{
    public function __construct(private readonly ImageCreator $imageCreator)
    {}

    public function render(): void
    {
        $image = $this->imageCreator->create($this->getMatrix(), $this->getScale());
        if (!$this->getFilename()) {
            header('Content-Type: image/gif');
            imagegif($image);
        } else {
            imagegif($image, $this->getFilename());
        }
        imagedestroy($image);
    }
}
