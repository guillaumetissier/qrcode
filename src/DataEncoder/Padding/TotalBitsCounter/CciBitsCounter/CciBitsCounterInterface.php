<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

interface CciBitsCounterInterface extends CounterInterface
{
    public function setVersion(Version $version): self;
}
