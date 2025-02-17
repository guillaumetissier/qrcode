<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Painter;

use ThePhpGuild\QrCode\MatrixRenderer\Canvas\CanvasInterface;

interface PainterInterface
{
    public function paint(CanvasInterface $canvas, array $data, int $scale): void;
}
