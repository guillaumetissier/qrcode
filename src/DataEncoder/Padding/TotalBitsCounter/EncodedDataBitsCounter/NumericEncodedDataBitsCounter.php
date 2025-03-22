<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class NumericEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $encodedDataBitsCount = intdiv($this->dataLength, 3) * 10;
        $rest = $this->dataLength % 3;
        if ($rest === 2) {
            $encodedDataBitsCount += 7;
        } elseif ($rest === 1) {
            $encodedDataBitsCount += 4;
        }

        $this->logger->debug("Number of encoded data bits is $encodedDataBitsCount");

        return $encodedDataBitsCount;
    }
}
