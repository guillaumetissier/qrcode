<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\Qrcode\DataEncoder\Mode\Mode;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\ErrorCorrectionLevel;

class VersionSelectorFactory
{
    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel): VersionSelectorInterface
    {
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
