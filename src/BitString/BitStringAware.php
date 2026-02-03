<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;

interface BitStringAware
{
    public function bitString(): BitStringInterface;
}
