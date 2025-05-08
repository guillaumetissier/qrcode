<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;

class Factory
{
    public function getDataCodewordsCounter(ErrorCorrectionLevel $errorCorrectionLevel): DataCodewordsCounterInterface
    {
        return [
            ErrorCorrectionLevel::LOW->value => new EclLowDataCodewordsCounter(),
            ErrorCorrectionLevel::MEDIUM->value => new EclMediumDataCodewordsCounter(),
            ErrorCorrectionLevel::QUARTILE->value => new EclQuartileDataCodewordsCounter(),
            ErrorCorrectionLevel::HIGH->value => new EclHighDataCodewordsCounter(),
        ][$errorCorrectionLevel->value];
    }
}
