<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\DataCodewordsCounter;

use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\EclQuartileDataCodewordsCounter;
use Guillaumetissier\QrCode\Enums\Version;

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
        $this->assertEquals($expectedCount, $this->counter->withVersion($version)->count());
    }

    public static function provideDataToTestCount(): \Generator
    {
        throw new \Exception('Not implemented');
    }
}
