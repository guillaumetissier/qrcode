<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

class JpgMatrixRenderer extends AbstractMatrixRenderer
{
    public function __construct(private readonly ImageCreator $imageCreator)
    {}

    public function render(): void
    {
        $image = $this->imageCreator->create($this->getMatrix(), $this->getScale());
        if (!$this->getFilename()) {
            header('Content-Type: image/jpeg');
            $image->toJpeg();
        } else {
            $image->toJpeg($this->getFilename());
        }
    }
}
