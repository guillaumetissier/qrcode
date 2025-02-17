<?php

namespace ThePhpGuild\QrCode\MatrixRenderer;

use ThePhpGuild\QrCode\Matrix\QrMatrix;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

interface MatrixRendererInterface
{
    public function setMatrix(QrMatrix $matrix): self;

    public function setOutputOptions(OutputOptions $outputOptions): self;

    public function render(): void;
}
