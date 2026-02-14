<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Commands\Output\OutputOptionsInterface;

interface BitMatrixPainterInterface
{
    public function withOutputOptions(OutputOptionsInterface $outputOptions): self;

    public function paint(BitMatrix $matrix): void;
}
