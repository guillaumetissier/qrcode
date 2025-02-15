<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class AlphanumericEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $totalBits = intdiv($this->dataLength, 2) * 11;
        if ($this->dataLength % 2 === 1) {
            $totalBits += 6;
        }

        return $totalBits;
    }
}
