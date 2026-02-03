<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

abstract class AbstractModeEncoder implements ModeEncoderInterface
{
    protected ?string $data = null;

    public function __construct(protected readonly ?IOLoggerInterface $logger)
    {
    }

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    abstract public function encode(): BitStringInterface;
}
