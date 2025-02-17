<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\ImagePainter;
use ThePhpGuild\QrCode\MatrixRenderer\Painter\PdfDocumentPainter;

class MatrixRendererBuilder
{
    /**
     * @throws UnhandledFileTypeException
     */
    public function buildRenderer(OutputOptions $outputOptions): MatrixRendererInterface
    {
        $renderer = match ($outputOptions->getFileType()) {
            FileType::GIF,
            FileType::JPG,
            FileType::PNG => new MatrixRenderer(new ImagePainter()),
            FileType::PDF => new MatrixRenderer(new PdfDocumentPainter()),
        };

        return $renderer->setOutputOptions($outputOptions);
    }
}
