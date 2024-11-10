<?php

namespace ThePhpGuild\Qrcode\MatrixRenderer;

use ThePhpGuild\Qrcode\Matrix\QrMatrix;

interface MatrixRendererInterface
{
    public function setMatrix(QrMatrix $matrix);

    public function render();
}
