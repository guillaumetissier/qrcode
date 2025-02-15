<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

abstract class AbstractEncodedDataBitsCounter implements EncodedDataBitsCounterInterface
{
    protected ?int $dataLength = null;

    public function setDataLength(int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    abstract public function count(): int;
}
