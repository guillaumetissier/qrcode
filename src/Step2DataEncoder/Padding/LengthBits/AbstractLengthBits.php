<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

abstract class AbstractLengthBits implements LengthBitsInterface
{
    protected ?int $dataLength = null;
    protected ?Version $version = null;

    public function __construct(protected readonly IOLoggerInterface $logger)
    {
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
        $this->logger->input("Version = {$this->version->value}", ['class' => static::class]);

        $lengthBits = $this->getModeDependentLengthBits();

        $this->logger->output("Length bits = $lengthBits", ['class' => static::class]);

        return $lengthBits;
    }

    abstract public function getModeDependentLengthBits(): string;
}
