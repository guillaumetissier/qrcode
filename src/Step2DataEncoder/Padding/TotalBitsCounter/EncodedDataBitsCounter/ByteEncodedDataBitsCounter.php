<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

class ByteEncodedDataBitsCounter extends AbstractEncodedDataBitsCounter
{
    public function modeDependentCount(): int
    {
        return $this->dataLength * 8;
    }
}
