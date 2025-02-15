<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\Qrcode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\ErrorCorrectionLevel;

class VersionSelectorFactory
{
    public function __construct(readonly private VersionFromIntConverter $converter)
    {
    }

    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $errorCorrectionLevel): VersionSelectorInterface
    {
        return match ($mode) {
            Mode::ALPHANUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector($this->converter),
                ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector($this->converter),
                ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector($this->converter),
                ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector($this->converter),
            },
            Mode::NUMERIC => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new NumericLowVersionSelector($this->converter),
                ErrorCorrectionLevel::MEDIUM => new NumericMediumVersionSelector($this->converter),
                ErrorCorrectionLevel::QUARTILE => new NumericQuartileVersionSelector($this->converter),
                ErrorCorrectionLevel::HIGH => new NumericHighVersionSelector($this->converter),
            },
            Mode::BYTE => match ($errorCorrectionLevel) {
                ErrorCorrectionLevel::LOW => new ByteLowVersionSelector($this->converter),
                ErrorCorrectionLevel::MEDIUM => new ByteMediumVersionSelector($this->converter),
                ErrorCorrectionLevel::QUARTILE => new ByteQuartileVersionSelector($this->converter),
                ErrorCorrectionLevel::HIGH => new ByteHighVersionSelector($this->converter),
            }
        };
    }
}
