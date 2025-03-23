<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class ByteCciBitsCounter extends AbstractCciBitsCounter
{
    public function modeDependentCount(): int
    {
        return $this->version->value <= 9 ? 8 : 16;
    }
}
