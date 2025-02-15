<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class NumericEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $totalBits = intdiv($this->dataLength, 3) * 10;
        $rest = $this->dataLength % 3;
        if ($rest === 2) {
            $totalBits += 7;
        } elseif ($rest === 1) {
            $totalBits += 4;
        }

        return $totalBits;
    }
}
