<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

use ThePhpGuild\Qrcode\DataEncoder\Mode\Mode;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\ErrorCorrectionLevel;

class VersionSelectorFactory
{
    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel)
    {
        switch ($mode) {
            case Mode::ALPHANUMERIC:
                return match ($errorCorrectionLevel) {
                    ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector(),
                    ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector(),
                    ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector(),
                    ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector(),
                };
            case Mode::NUMERIC:
                return match ($errorCorrectionLevel) {
                    ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector(),
                    ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector(),
                    ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector(),
                    ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector(),
                };
        }
    }
}