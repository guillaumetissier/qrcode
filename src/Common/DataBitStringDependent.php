<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\BitString\BitStringInterface;

interface DataBitStringDependent
{
    public function withData(BitStringInterface $data): self;
}
