<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeDetector;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\VersionSelectorFactory;

class Step1DataAnalyser
{
    private ?string $data = null;
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;
    private ?Mode $mode = null;
    private ?Version $version = null;

    public function __construct(
        private readonly ModeDetector $modeDetector,
        private readonly VersionSelectorFactory $versionSelectorFactory,
        private readonly IOLoggerInterface $logger
    )
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;
        $this->mode = null;
        $this->version = null;

        return $this;
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;
        $this->version = null;

        return $this;
    }

    public function getMode(): Mode
    {
        if ($this->mode === null) {
            $this->logger->info('Detecting mode', ['class' => self::class]);
            $this->mode = $this->modeDetector->setData($this->data)->detect();
        }

        return $this->mode;
    }

    public function getVersion(): Version
    {
        if ($this->version === null) {
            $this->logger->info('Detecting version', ['class' => self::class]);
            $this->version = $this->versionSelectorFactory
                ->getVersionSelector($this->getMode(), $this->errorCorrectionLevel)
                ->selectVersion(strlen($this->data));
        }

        return $this->version;
    }
}
