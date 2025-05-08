<?php

namespace Tests\Step2DataEncodation\DataCodewordsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclHighDataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclLowDataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclMediumDataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclQuartileDataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\Factory;

class FactoryTest extends TestCase
{
    private Factory $factory;

    public function setUp(): void
    {
        $this->factory = new Factory();
    }

    /**
     * @dataProvider provideDataToTestGetDataCodewordsCounter
     */
    public function testGetDataCodewordsCounter(ErrorCorrectionLevel $errorCorrectionLevel, string $expectedClass): void
    {
        $this->assertInstanceOf($expectedClass, $this->factory->getDataCodewordsCounter($errorCorrectionLevel));
    }

    public static function provideDataToTestGetDataCodewordsCounter(): \Generator
    {
        yield [ErrorCorrectionLevel::LOW, EclLowDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::MEDIUM, EclMediumDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::QUARTILE, EclQuartileDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::HIGH, EclHighDataCodewordsCounter::class];
    }
}
