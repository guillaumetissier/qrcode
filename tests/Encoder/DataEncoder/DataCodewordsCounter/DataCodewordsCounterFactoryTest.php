<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclHighDataCodewordsCounter;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclLowDataCodewordsCounter;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclMediumDataCodewordsCounter;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclQuartileDataCodewordsCounter;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use PHPUnit\Framework\TestCase;

class DataCodewordsCounterFactoryTest extends TestCase
{
    private DataCodewordsCounterFactory $factory;

    public function setUp(): void
    {
        $this->factory = DataCodewordsCounterFactory::create();
    }

    /**
     * @param ErrorCorrectionLevel $errorCorrectionLevel
     * @param class-string $expectedClass
     * @return void
     * @dataProvider dataGetDataCodewordsCounter
     */
    public function testGetDataCodewordsCounter(ErrorCorrectionLevel $errorCorrectionLevel, string $expectedClass): void
    {
        $this->assertInstanceOf($expectedClass, $this->factory->getDataCodewordsCounter($errorCorrectionLevel));
    }

    public static function dataGetDataCodewordsCounter(): \Generator
    {
        yield [ErrorCorrectionLevel::LOW, EclLowDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::MEDIUM, EclMediumDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::QUARTILE, EclQuartileDataCodewordsCounter::class];
        yield [ErrorCorrectionLevel::HIGH, EclHighDataCodewordsCounter::class];
    }
}
