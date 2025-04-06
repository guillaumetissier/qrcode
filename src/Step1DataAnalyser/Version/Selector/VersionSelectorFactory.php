<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\Mode;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class VersionSelectorFactory
{
    public function __construct(private readonly IOLoggerInterface $logger)
    {
    }

    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel): VersionSelectorInterface
    {
        $this->logger->input("Mode = {$mode->value}, ECL = {$errorCorrectionLevel->value}", ['class' => static::class]);

        $versionSelector = match ($mode) {
            Mode::ALPHANUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector($this->logger),
            },
            Mode::NUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new NumericLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new NumericMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new NumericQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new NumericHighVersionSelector($this->logger),
            },
            Mode::BYTE => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new ByteLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new ByteMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new ByteQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new ByteHighVersionSelector($this->logger),
            }
        };

        $this->logger->output("Creation of " . $versionSelector::class, ['class' => static::class]);

        return $versionSelector;
    }
}
