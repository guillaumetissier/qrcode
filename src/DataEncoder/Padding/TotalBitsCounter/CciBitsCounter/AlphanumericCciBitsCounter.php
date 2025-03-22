<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class AlphanumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->value <= 9) {
            $this->logger->debug("Number of CCI bits is 9");

            return 9;
        }

        if ($this->version->value >= 10 && $this->version->value <= 26) {
            $this->logger->debug("Number of CCI bits is 11");

            return 11;
        }

        $this->logger->debug("Number of CCI bits is 13");

        return 13;
    }
}
