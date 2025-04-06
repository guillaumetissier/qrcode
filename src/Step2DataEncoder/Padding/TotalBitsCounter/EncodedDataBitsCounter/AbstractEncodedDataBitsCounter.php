<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

abstract class AbstractEncodedDataBitsCounter implements EncodedDataBitsCounterInterface
{
    protected ?int $dataLength = null;

    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function setDataLength(int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    public function count(): int
    {
        $this->logger->input("Data length = {$this->dataLength}", ['class' => static::class]);

        $encodedDataBitsCount = $this->modeDependentCount();

        $this->logger->output("Encoded data bits count = $encodedDataBitsCount", ['class' => static::class]);

        return $encodedDataBitsCount;
    }

    abstract public function modeDependentCount(): int;
}
