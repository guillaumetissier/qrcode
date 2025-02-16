<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class AlphanumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->toInt() <= 9) {
            return 9;
        }

        if ($this->version->toInt() >= 10 && $this->version->toInt() <= 26) {
            return 11;
        }

        return 13;
    }
}
