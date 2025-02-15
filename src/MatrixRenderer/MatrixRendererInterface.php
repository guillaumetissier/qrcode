<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Matrix\QrMatrix;

interface MatrixRendererInterface
{
    public function setFilename(string $filename): self;

    public function setMatrix(QrMatrix $matrix): self;

    public function render(): void;
}
