<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Mode;

interface ModeDependent
{
    public function withMode(Mode $mode): self;
}
