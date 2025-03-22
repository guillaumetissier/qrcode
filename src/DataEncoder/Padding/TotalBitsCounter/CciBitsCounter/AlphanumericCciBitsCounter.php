<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

class AlphanumericCciBitsCounter extends AbstractCciBitsCounter
{
    public function count(): int
    {
        if ($this->version->value <= 9) {
            $this->logger->debug("Output >> 9 CCI bits");

            return 9;
        }

        if ($this->version->value >= 10 && $this->version->value <= 26) {
            $this->logger->debug("Output >> 11 CCI bits");

            return 11;
        }

        $this->logger->debug("Output >> 13 CCI bits");

        return 13;
    }
}
