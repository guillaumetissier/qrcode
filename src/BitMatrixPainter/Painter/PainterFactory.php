<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\BitMatrixPainter\PainterFactoryInterface;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;

final class PainterFactory implements PainterFactoryInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function createPainter(FileType $fileType): PainterInterface
    {
        return match ($fileType) {
            FileType::GIF,
            FileType::JPG,
            FileType::PNG => new ImagePainter(),
            FileType::PDF => new PdfDocumentPainter(),
        };
    }
}
