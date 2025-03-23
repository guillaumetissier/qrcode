<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractLengthBits implements LengthBitsInterface
{
    protected ?int $dataLength = null;
    protected ?Version $version = null;

    public function __construct(protected readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(static::class);
    }

    public function setDataLength(?int $dataLength): self
    {
        $this->dataLength = $dataLength;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getLengthBits(): string
    {
        $this->logger->debug("Input << Version {$this->version->value}");

        $lengthBits = $this->getModeDependentLengthBits();

        $this->logger->debug("Output >> Length bits = $lengthBits");

        return $lengthBits;
    }

    abstract public function getModeDependentLengthBits(): string;
}
