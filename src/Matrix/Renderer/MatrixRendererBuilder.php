<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer;

use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\Matrix\Renderer\File\FileType;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\ImagePainter;
use ThePhpGuild\QrCode\Matrix\Renderer\Painter\PdfDocumentPainter;

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
