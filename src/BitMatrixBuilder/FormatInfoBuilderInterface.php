<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mask;

interface FormatInfoBuilderInterface
{
    public function withMask(Mask $mask): self;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $ecl): self;

    public function build(): BitStringInterface;
}
