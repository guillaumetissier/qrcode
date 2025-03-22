<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class ByteEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $encodedDataBitsCount = $this->dataLength * 8;

        $this->logger->debug("Number of encoded data bits is $encodedDataBitsCount");

        return $encodedDataBitsCount;
    }
}
