<?php

namespace ThePhpGuild\QrCode\DataEncoder;

use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

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
        private readonly LevelFilteredLogger $logger
    )
    {
        $this->logger->setPrefix(self::class);
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
            $this->logger->notice('Detecting mode');
            $this->mode = $this->modeDetector
                ->setData($this->data)
                ->detect();

            $this->logger->info("Output >> Mode = {$this->mode->value}");
        }

        return $this->mode;
    }

    public function getVersion(): Version
    {
        if ($this->version === null) {
            $this->logger->notice('Detecting version');
            $this->version = $this->versionSelectorFactory
                ->getVersionSelector($this->mode, $this->errorCorrectionLevel)
                ->selectVersion(strlen($this->data));

            $this->logger->info("Output >> Version = {$this->version->value}");
        }

        return $this->version;
    }

    public function getEncodedData(): string
    {
        if ($this->encodedData === null) {
            $this->logger->notice('Encoding data');
            $this->encodedData = $this->encoderFactory
                ->getEncoder($this->mode)
                ->setData($this->data)
                ->encode();

            $this->logger->info("Output >> Encoded data = {$this->encodedData}");
        }

        return $this->encodedData;
    }

    public function getPaddedData(): string
    {
        if ($this->paddedData === null) {
            $this->logger->notice('Padding data');
            $this->paddedData = $this->paddingAdder
                ->setMode($this->mode)
                ->setVersion($this->version)
                ->setData($this->encodedData)
                ->appendPadding();

            $this->logger->info("Output >> Padded data = {$this->paddedData}");
        }

        return $this->paddedData;
    }
}
