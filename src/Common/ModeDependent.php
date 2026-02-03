<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Mode;

interface ModeDependent
{
    public function withMode(Mode $mode): self;
}
