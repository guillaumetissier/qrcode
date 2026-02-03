<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\BitString\BitStringInterface;

interface DataBitStringDependent
{
    public function withData(BitStringInterface $data): self;
}
