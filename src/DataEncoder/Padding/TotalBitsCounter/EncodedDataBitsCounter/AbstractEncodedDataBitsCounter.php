<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractEncodedDataBitsCounter implements EncodedDataBitsCounterInterface
{
    protected ?int $dataLength = null;

    public function __construct(protected readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(self::class);
    }

    public function setDataLength(int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    abstract public function count(): int;
}
