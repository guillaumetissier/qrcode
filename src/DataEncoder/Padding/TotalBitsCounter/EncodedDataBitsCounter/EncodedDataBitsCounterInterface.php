<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CounterInterface;

interface EncodedDataBitsCounterInterface extends CounterInterface
{
    public function setDataLength(int $dataLength): self;
}
