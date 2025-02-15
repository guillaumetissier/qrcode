<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class ByteCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        return $this->version->toInt() <= 9 ? 8 : 16;
    }
}
