<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

interface CciBitsCounterInterface extends CounterInterface
{
    public function setVersion(Version $version): self;
}
