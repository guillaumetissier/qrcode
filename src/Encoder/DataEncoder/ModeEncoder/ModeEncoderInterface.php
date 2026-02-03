<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\BitString\BitStringInterface;

interface ModeEncoderInterface
{
    public function withData(string $data): self;

    public function encode(): BitStringInterface;
}
