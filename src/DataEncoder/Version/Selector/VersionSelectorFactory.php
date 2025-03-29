<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
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
                ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector(clone $this->logger),
            },
            Mode::NUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new NumericLowVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::MEDIUM => new NumericMediumVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::QUARTILE => new NumericQuartileVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::HIGH => new NumericHighVersionSelector(clone $this->logger),
            },
            Mode::BYTE => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new ByteLowVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::MEDIUM => new ByteMediumVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::QUARTILE => new ByteQuartileVersionSelector(clone $this->logger),
                ErrorCorrectionLevel::HIGH => new ByteHighVersionSelector(clone $this->logger),
            }
        };

        $this->logger->output("Creation of " . $versionSelector::class, ['class' => static::class]);

        return $versionSelector;
    }
}
