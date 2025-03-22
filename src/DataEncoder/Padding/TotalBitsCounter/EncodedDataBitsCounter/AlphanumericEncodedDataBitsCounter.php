<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class AlphanumericEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $encodedDataBitsCount = intdiv($this->dataLength, 2) * 11;
        if ($this->dataLength % 2 === 1) {
            $encodedDataBitsCount += 6;
        }

        $this->logger->debug("Number of encoded data bits is $encodedDataBitsCount");

        return $encodedDataBitsCount;
    }
}
