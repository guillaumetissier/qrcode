<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;

interface BitStringAware
{
    public function bitString(): BitStringInterface;
}
