<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\BitMatrixPainter\CanvasFactoryInterface;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\Exception\ImageNotCreatedException;

final class CanvasFactory implements CanvasFactoryInterface
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

    /**
     * @throws ImageNotCreatedException
     */
    public function createCanvas(FileType $fileType, int $imageSize): CanvasInterface
    {
        return match ($fileType) {
            FileType::PDF => PdfDocument::createA4(),
            FileType::GIF,
            FileType::JPG,
            FileType::PNG => new Image($imageSize, $imageSize)
        };
    }
}
