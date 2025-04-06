<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CounterInterface;

interface EncodedDataBitsCounterInterface extends CounterInterface
{
    public function setDataLength(int $dataLength): self;
}
