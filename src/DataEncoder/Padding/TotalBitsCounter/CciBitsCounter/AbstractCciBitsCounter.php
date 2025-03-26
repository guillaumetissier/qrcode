<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

abstract class AbstractCciBitsCounter implements CciBitsCounterInterface
{
    protected ?Version $version = null;

    public function __construct(private readonly IOLoggerInterface $logger)
    {
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

        $this->logger->input("Version = {$this->version->value}", ['class' => static::class]);

        $cciBitsCount = $this->modeDependentCount();

        $this->logger->output("CCI bits count = $cciBitsCount");

        return $cciBitsCount;
    }

    abstract public function modeDependentCount(): int;
}
