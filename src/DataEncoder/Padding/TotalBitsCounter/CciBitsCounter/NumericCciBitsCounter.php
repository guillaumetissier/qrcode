<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class NumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->value <= 9) {
            $this->logger->debug("Number of CCI bits is 10");

            return 10;
        }

        if ($this->version->value >= 10 && $this->version->value <= 26) {
            $this->logger->debug("Number of CCI bits is 12");

            return 12;
        }

        $this->logger->debug("Number of CCI bits is 14");

        return 14;
    }
}
