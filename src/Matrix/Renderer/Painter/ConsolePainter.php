<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer\Painter;

use ThePhpGuild\QrCode\Matrix\Matrix;

class ConsolePainter implements PainterInterface
{
    public function paint(Matrix $matrix): void
    {
        echo "$matrix";
    }
}
