<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class AlphanumericEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function modeDependentCount(): int
    {
        $encodedDataBitsCount = intdiv($this->dataLength, 2) * 11;
        if ($this->dataLength % 2 === 1) {
            $encodedDataBitsCount += 6;
        }

        return $encodedDataBitsCount;
    }
}
