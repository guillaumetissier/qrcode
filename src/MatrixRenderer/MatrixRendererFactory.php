<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\File\FileType;

class MatrixRendererFactory
{
    public function getRenderer(FileType $fileType): MatrixRendererInterface
    {
        return match ($fileType) {
            FileType::GIF => new GifMatrixRenderer(new ImageCreator()),
            FileType::JPG => new JpgMatrixRenderer(new ImageCreator()),
            FileType::PDF => new PdfMatrixRenderer(),
            FileType::PNG => new PngMatrixRenderer(new ImageCreator()),
        };
    }
}
