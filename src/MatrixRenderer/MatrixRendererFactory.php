<?php

namespace ThePhpGuild\Qrcode\MatrixRenderer;

class MatrixRendererFactory
{
    public function getRenderer(FileType $fileType): MatrixRendererInterface
    {
        return match ($fileType) {
            FileType::JPG => new JpgMatrixRenderer(),
            FileType::PDF => new PdfMatrixRenderer(),
            FileType::PNG => new PngMatrixRenderer()
        };
    }
}
