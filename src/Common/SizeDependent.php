<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

interface SizeDependent
{
    public function withSize(int $size): self;
}
