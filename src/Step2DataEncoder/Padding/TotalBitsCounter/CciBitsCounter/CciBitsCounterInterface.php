<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CounterInterface;

interface CciBitsCounterInterface extends CounterInterface
{
    public function setVersion(Version $version): self;
}
