<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Canvas;

use Guillaumetissier\QrCode\Commands\Output\OutputInterface;

interface CanvasInterface extends OutputInterface
{
    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self;

    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool;
}
