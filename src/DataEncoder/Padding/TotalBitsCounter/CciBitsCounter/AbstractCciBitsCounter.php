<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractCciBitsCounter implements CciBitsCounterInterface
{
    protected ?Version $version = null;

    public function __construct(private readonly LevelFilteredLogger $logger)
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

    public function count(): int
    {
        if (null === $this->version) {
            throw new VariableNotSetException('version');
        }

        $this->logger->debug("Input << Version = {$this->version->value}");

        $cciBitsCount = $this->specificCount();

        $this->logger->debug("Output >> CCI bits count = $cciBitsCount");

        return $cciBitsCount;
    }

    abstract public function specificCount(): int;
}
