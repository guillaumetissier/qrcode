<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Common\Helper\ClassNameHelper;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounterFactoryInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class DataCodewordsCounterFactory implements DataCodewordsCounterFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    public function getDataCodewordsCounter(ErrorCorrectionLevel $errorCorrectionLevel): DataCodewordsCounterInterface
    {
        $this->logger?->input("ECL = {$errorCorrectionLevel->value}", ['class' => self::class]);

        $codewordsCounter = [
            ErrorCorrectionLevel::LOW->value => new EclLowDataCodewordsCounter(),
            ErrorCorrectionLevel::MEDIUM->value => new EclMediumDataCodewordsCounter(),
            ErrorCorrectionLevel::QUARTILE->value => new EclQuartileDataCodewordsCounter(),
            ErrorCorrectionLevel::HIGH->value => new EclHighDataCodewordsCounter(),
        ][$errorCorrectionLevel->value];

        $this->logger?->output(
            "Codeword counter = " . ClassNameHelper::getClassName(get_class($codewordsCounter)),
            ['class' => self::class]
        );

        return $codewordsCounter;
    }
}
