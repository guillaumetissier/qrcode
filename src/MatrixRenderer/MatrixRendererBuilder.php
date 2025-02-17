<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\ImagePainter;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\PdfDocumentPainter;

class MatrixRendererBuilder
{
    public function getRenderer(FileType $fileType): MatrixRendererInterface
    {
        return match ($fileType) {
            FileType::GIF,
            FileType::JPG,
            FileType::PNG => new MatrixRenderer(new ImagePainter()),
            FileType::PDF => new MatrixRenderer(new PdfDocumentPainter()),
        };
    }
}
