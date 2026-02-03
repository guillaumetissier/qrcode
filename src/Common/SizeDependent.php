<?php

namespace Guillaumetissier\QrCode\Common;

interface SizeDependent
{
    public function withSize(int $size): self;
}
