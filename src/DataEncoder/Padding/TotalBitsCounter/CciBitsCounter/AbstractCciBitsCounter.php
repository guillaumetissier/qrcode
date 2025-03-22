<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractCciBitsCounter implements CciBitsCounterInterface
{
    protected ?Version $version = null;

    public function __construct(protected readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(static::class);
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function count(): int;
}
