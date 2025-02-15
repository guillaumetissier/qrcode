<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class NumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->toInt() <= 9) {
            return 10;
        }

        if ($this->version->toInt() >= 10 && $this->version->toInt() <= 26) {
            return 12;
        }

        return 14;
    }
}
