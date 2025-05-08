<?php

namespace Tests\Step2DataEncodation;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\AbstractDataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\DataCodewordsCounterInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\Factory as DataCodewordsCounterFactory;

class DataCodewordsCounterTest extends TestCase
{
    private DataCodewordsCounter $counter;

    public function setUp(): void
    {
        $factory = $this->createMock(DataCodewordsCounterFactory::class);
        $factory->expects(self::any())
            ->method('getDataCodewordsCounter')
            ->willReturnMap([
                [
                    ErrorCorrectionLevel::LOW,
                    $this->createMockDataCodewordsCounter(ErrorCorrectionLevel::LOW)
                ],
                [
                    ErrorCorrectionLevel::MEDIUM,
                    $this->createMockDataCodewordsCounter(ErrorCorrectionLevel::MEDIUM)
                ],
                [
                    ErrorCorrectionLevel::QUARTILE,
                    $this->createMockDataCodewordsCounter(ErrorCorrectionLevel::QUARTILE)
                ],
                [
                    ErrorCorrectionLevel::HIGH,
                    $this->createMockDataCodewordsCounter(ErrorCorrectionLevel::HIGH)
                ],
            ]);

        $this->counter = new DataCodewordsCounter($factory);
    }

    /**
     * @dataProvider provideDataToTestCount
     */
    public function testCount(ErrorCorrectionLevel $ecl, Version $version, int $expectedCount): void
    {
        $this->assertEquals(
            $expectedCount,
            $this->counter->setErrorCorrectionLevel($ecl)->setVersion($version)->count()
        );
    }

    public static function provideDataToTestCount(): \Generator
    {
        yield [ErrorCorrectionLevel::LOW, Version::V04, 4];
        yield [ErrorCorrectionLevel::MEDIUM, Version::V08, 16];
        yield [ErrorCorrectionLevel::QUARTILE, Version::V21, 63];
        yield [ErrorCorrectionLevel::HIGH, Version::V33, 132];
    }

    private function createMockDataCodewordsCounter(ErrorCorrectionLevel $ecl): DataCodewordsCounterInterface
    {
        return new class($ecl) extends AbstractDataCodewordsCounter {
            public function __construct(private readonly ErrorCorrectionLevel $ecl)
            {}
            public function count(): int
            {
                return $this->version->value * (int)(1 + array_search($this->ecl, [
                    ErrorCorrectionLevel::LOW,
                    ErrorCorrectionLevel::MEDIUM,
                    ErrorCorrectionLevel::QUARTILE,
                    ErrorCorrectionLevel::HIGH
                ]));
            }
        };
    }
}
