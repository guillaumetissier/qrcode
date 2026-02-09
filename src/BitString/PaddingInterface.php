<?php

namespace Guillaumetissier\QrCode\BitString;

interface PaddingInterface extends BitStringAware
{
    public function withDataBitCount(int $dataBitCount): self;

    public function withTotalCodewords(int $totalCodewords): self;
}
