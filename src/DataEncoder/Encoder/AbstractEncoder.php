<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

abstract class AbstractEncoder implements EncoderInterface
{
    protected ?string $data = null;

    public function __construct(protected readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(static::class);
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    abstract public function encode(): string;
}
