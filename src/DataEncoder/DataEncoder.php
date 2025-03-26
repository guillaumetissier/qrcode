<?php

namespace ThePhpGuild\QrCode\DataEncoder;

use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class DataEncoder
{
    private ?string $data = null;
    private ?Mode $mode = null;
    private ?Version $version = null;
    private ?string $encodedData = null;
    private ?string $paddedData = null;
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function __construct(
        private readonly ModeDetector $modeDetector,
        private readonly VersionSelectorFactory $versionSelectorFactory,
        private readonly EncoderFactory $encoderFactory,
        private readonly PaddingAppender $paddingAdder,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;
        $this->mode = null;
        $this->version = null;
        $this->encodedData = null;
        $this->paddedData = null;

        return $this;
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;
        $this->version = null;
        $this->encodedData = null;
        $this->paddedData = null;

        return $this;
    }

    public function encode(): string
    {
        $this->getMode();
        $this->getVersion();
        $this->getEncodedData();
        return $this->getPaddedData();
    }

    public function getMode(): Mode
    {
        if ($this->mode === null) {
            $this->logger->info('Detecting mode');
            $this->mode = $this->modeDetector->setData($this->data)->detect();
        }

        return $this->mode;
    }

    public function getVersion(): Version
    {
        if ($this->version === null) {
            $this->logger->info('Detecting version');
            $this->version = $this->versionSelectorFactory
                ->getVersionSelector($this->mode, $this->errorCorrectionLevel)
                ->selectVersion(strlen($this->data));
        }

        return $this->version;
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
