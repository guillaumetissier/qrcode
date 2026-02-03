<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter;

use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\PainterInterface;

interface PainterFactoryInterface
{
    public function createPainter(FileType $fileType): PainterInterface;
}
