<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\QrCode\Enums\Mask;

interface MaskReferenceInterface extends BitStringAware
{
    public function withMask(Mask $mask): self;
}
