<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;

interface BitMatrixPainterInterface
{
    public function setOutputOptions(OutputOptions $outputOptions): self;

    public function paint(BitMatrix $matrix): void;
}
