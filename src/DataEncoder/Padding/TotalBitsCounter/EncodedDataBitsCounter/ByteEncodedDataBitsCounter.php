<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class ByteEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function count(): int
    {
        $encodedDataBitsCount = $this->dataLength * 8;

        $this->logger->debug("Output >> $encodedDataBitsCount encoded data bits");

        return $encodedDataBitsCount;
    }
}
