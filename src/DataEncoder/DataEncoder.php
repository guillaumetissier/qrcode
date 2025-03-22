<?php

namespace ThePhpGuild\QrCode\DataEncoder;

use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class DataEncoder
{
    private ?string $data = null;
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

        return $this;
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function encode(): string
    {
        $this->logger->info('Detecting mode');

        $mode = $this->modeDetector
            ->setData($this->data)
            ->detect();

        $this->logger->info('Detecting version');

        $version = $this->versionSelectorFactory
            ->getVersionSelector($mode, $this->errorCorrectionLevel)
            ->selectVersion(strlen($this->data));

        $this->logger->info('Encoding data');

        $encodedData = $this->encoderFactory
            ->getEncoder($mode)
            ->setData($this->data)
            ->encode();

        $this->logger->info('Padding data');

        $paddedData = $this->paddingAdder
            ->setMode($mode)
            ->setVersion($version)
            ->setData($encodedData)
            ->appendPadding();

        return $paddedData;
    }
}
