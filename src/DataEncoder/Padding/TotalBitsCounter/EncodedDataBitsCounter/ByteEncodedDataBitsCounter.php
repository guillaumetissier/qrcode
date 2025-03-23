<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class ByteEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function modeDependentCount(): int
    {
        return $this->dataLength * 8;
    }
}
