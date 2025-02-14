<?php

namespace ThePhpGuild\Qrcode\MatrixRenderer;

use ThePhpGuild\Qrcode\Matrix\QrMatrix;

interface MatrixRendererInterface
{
    public function setFilename(string $filename): self;

    public function setMatrix(QrMatrix $matrix): self;

    public function render(): void;
}
