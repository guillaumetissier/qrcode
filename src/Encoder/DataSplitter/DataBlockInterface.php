<?php

namespace Guillaumetissier\QrCode\Encoder\DataSplitter;

use Guillaumetissier\BitString\BitStringInterface;

interface DataBlockInterface
{
    public function data(): BitStringInterface;

    public function numErrorCorrectionCodewords(): int;
}
