<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter;

use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;

interface CanvasFactoryInterface
{
    public function createCanvas(FileType $fileType, int $imageSize): CanvasInterface;
}
