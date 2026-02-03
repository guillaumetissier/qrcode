<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounterFactoryInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

final class DataCodewordsCounterFactory implements DataCodewordsCounterFactoryInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

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
