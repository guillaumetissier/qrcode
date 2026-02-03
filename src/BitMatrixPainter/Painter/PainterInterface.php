<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Painter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasInterface;

interface PainterInterface
{
    public function withCanvas(CanvasInterface $canvas): self;

    public function withScale(int $scale): self;

    public function paint(BitMatrix $matrix): void;
}
