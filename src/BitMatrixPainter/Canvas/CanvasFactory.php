<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\BitMatrixPainter\CanvasFactoryInterface;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class CanvasFactory implements CanvasFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    /**
     * @param FileType $fileType
     * @param int $imageSize
     * @return CanvasInterface
     */
    public function createCanvas(FileType $fileType, int $imageSize): CanvasInterface
    {
        return match ($fileType) {
            FileType::PDF => PdfDocument::createA4($this->logger),
            FileType::GIF,
            FileType::JPG,
            FileType::PNG => Image::create($imageSize, $imageSize, $this->logger)
        };
    }
}
