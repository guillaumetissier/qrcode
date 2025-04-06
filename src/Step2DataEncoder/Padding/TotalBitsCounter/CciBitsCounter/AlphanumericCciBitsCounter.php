<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class AlphanumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function modeDependentCount(): int
    {
        if ($this->version->value <= 9) {
            return 9;
        }

        if ($this->version->value <= 26) {
            return 11;
        }

        return 13;
    }
}
