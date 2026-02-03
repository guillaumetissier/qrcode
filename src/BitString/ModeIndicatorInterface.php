<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\QrCode\Enums\Mode;

interface ModeIndicatorInterface extends BitStringAware
{
    public function withMode(Mode $mode): self;
}
