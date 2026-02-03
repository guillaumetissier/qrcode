<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder;

use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderInterface;
use Guillaumetissier\QrCode\Enums\Mode;

interface ModeEncoderFactoryInterface
{
    public function getModeEncoder(Mode $mode): ModeEncoderInterface;
}
