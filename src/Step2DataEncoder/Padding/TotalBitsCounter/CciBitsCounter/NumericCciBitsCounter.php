<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class NumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function modeDependentCount(): int
    {
        if ($this->version->value <= 9) {
            return 10;
        }

        if ($this->version->value <= 26) {
            return 12;
        }

        return 14;
    }
}
