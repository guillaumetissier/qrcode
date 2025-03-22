<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class NumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->value <= 9) {
            $this->logger->debug("Output >> 10 CCI bits");

            return 10;
        }

        if ($this->version->value >= 10 && $this->version->value <= 26) {
            $this->logger->debug("Output >> 12 CCI bits");

            return 12;
        }

        $this->logger->debug("Output >> 14 CCI bits");

        return 14;
    }
}
