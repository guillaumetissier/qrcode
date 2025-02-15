<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\CounterInterface;

interface EncodedDataBitsCounterInterface extends CounterInterface
{
    public function setDataLength(int $dataLength): self;
}
