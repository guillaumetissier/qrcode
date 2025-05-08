<?php

namespace Tests\Step2DataEncodation\DataCodewordsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\DataCodewordsCounterInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\EclQuartileDataCodewordsCounter;

class DataCodewordsCounterTestCase extends TestCase
{
    protected DataCodewordsCounterInterface $counter;

    protected function setUp(): void
    {
        $this->counter = new EclQuartileDataCodewordsCounter();
    }

    /**
     * @dataProvider provideDataToTestCount
     */
    public function testCount(Version $version, int $expectedCount): void
    {
        $this->assertEquals($expectedCount, $this->counter->setVersion($version)->count());
    }

    public static function provideDataToTestCount(): \Generator
    {
        throw new \Exception('Not implemented');
    }
}
