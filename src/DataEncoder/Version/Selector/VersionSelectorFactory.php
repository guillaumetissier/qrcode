<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class VersionSelectorFactory
{
    public function __construct(private readonly LevelFilteredLogger $logger)
    {
        $this->logger->setPrefix(self::class);
    }

    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel): VersionSelectorInterface
    {
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

        $this->logger->debug("(Mode:{$mode->value}, ECL:{$errorCorrectionLevel->value}) => " . $versionSelector::class);

        return $versionSelector;
    }
}
