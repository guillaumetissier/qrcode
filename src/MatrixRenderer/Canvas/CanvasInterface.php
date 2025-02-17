<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Canvas;

interface CanvasInterface
{
    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self;

    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool;
}
