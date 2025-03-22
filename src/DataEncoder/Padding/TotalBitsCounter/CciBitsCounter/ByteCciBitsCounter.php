<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class ByteCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        $count = $this->version->value <= 9 ? 8 : 16;

        $this->logger->debug("Output >> $count CCI bits");

        return $count;
    }
}
