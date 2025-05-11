<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Matrix\Matrix;

interface PainterInterface
{
    public function paint(Matrix $matrix): void;
}
