<?php

namespace ThePhpGuild\QrCode\Matrix\Renderer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Matrix\Renderer\Output\OutputOptions;

interface MatrixRendererInterface
{
    public function setMatrix(Matrix $matrix): self;

    public function setOutputOptions(OutputOptions $outputOptions): self;

    public function render(): void;
}
