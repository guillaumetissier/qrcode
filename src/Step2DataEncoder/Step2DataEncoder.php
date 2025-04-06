<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder;

use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\Mode;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class Step2DataEncoder
{
    private ?string $data = null;
    private ?Mode $mode = null;
    private ?Version $version = null;
    private ?string $encodedData = null;
    private ?string $paddedData = null;

    public function __construct(
        private readonly EncoderFactory $encoderFactory,
        private readonly PaddingAppender $paddingAdder,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;
        $this->encodedData = null;
        $this->paddedData = null;

        return $this;
    }

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function encode(): string
    {
        $this->getEncodedData();
        return $this->getPaddedData();
    }

    public function getEncodedData(): string
    {
        if ($this->encodedData === null) {
            $this->logger->info('Encoding data');
            $this->encodedData = $this->encoderFactory
                ->getEncoder($this->mode)
                ->setData($this->data)
                ->encode();
        }

        return $this->encodedData;
    }

    public function getPaddedData(): string
    {
        if ($this->paddedData === null) {
            $this->logger->info('Padding data');
            $this->paddedData = $this->paddingAdder
                ->setMode($this->mode)
                ->setVersion($this->version)
                ->setData($this->encodedData)
                ->appendPadding();
        }

        return $this->paddedData;
    }
}
