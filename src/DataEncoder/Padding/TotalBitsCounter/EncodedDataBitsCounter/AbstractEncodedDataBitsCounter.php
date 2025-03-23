<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractEncodedDataBitsCounter implements EncodedDataBitsCounterInterface
{
    protected ?int $dataLength = null;

    public function __construct(private readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(static::class);
    }

    public function setDataLength(int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    public function count(): int
    {
        $this->logger->input("Data length = {$this->dataLength}");

        $encodedDataBitsCount = $this->modeDependentCount();

        $this->logger->output("Encoded data bits count = $encodedDataBitsCount");

        return $encodedDataBitsCount;
    }

    abstract public function modeDependentCount(): int;
}
