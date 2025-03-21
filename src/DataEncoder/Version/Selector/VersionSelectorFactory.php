<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class VersionSelectorFactory
{
    public function __construct(private readonly LevelFilteredLogger $logger)
    {
    }

    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel): VersionSelectorInterface
    {
        $this->logger->debug("Get version selector for mode {$mode->value} and ECL {$errorCorrectionLevel->value}");

        return match ($mode) {
            Mode::ALPHANUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector(),
                ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector(),
                ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector(),
                ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector(),
            },
            Mode::NUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new NumericLowVersionSelector(),
                ErrorCorrectionLevel::MEDIUM => new NumericMediumVersionSelector(),
                ErrorCorrectionLevel::QUARTILE => new NumericQuartileVersionSelector(),
                ErrorCorrectionLevel::HIGH => new NumericHighVersionSelector(),
            },
            Mode::BYTE => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new ByteLowVersionSelector(),
                ErrorCorrectionLevel::MEDIUM => new ByteMediumVersionSelector(),
                ErrorCorrectionLevel::QUARTILE => new ByteQuartileVersionSelector(),
                ErrorCorrectionLevel::HIGH => new ByteHighVersionSelector(),
            }
        };
    }
}
