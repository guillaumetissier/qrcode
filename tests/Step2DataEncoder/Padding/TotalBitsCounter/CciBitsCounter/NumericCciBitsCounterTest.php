<?php

namespace Tests\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;

class NumericCciBitsCounterTest extends LoggerTestCase
{
    private NumericCciBitsCounter $cciBitsCounter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cciBitsCounter = new NumericCciBitsCounter($this->logger);
    }

    /**
     * @dataProvider provideDataToCount
     */
    public function testCount(Version $version, int $expectedTotal): void
    {
        $this->assertEquals($expectedTotal, $this->cciBitsCounter->setVersion($version)->count());
    }

    public static function provideDataToCount(): array
    {
        return [
            [Version::V01, 10],
            [Version::V09, 10],
            [Version::V10, 12],
            [Version::V26, 12],
            [Version::V27, 14],
            [Version::V40, 14],
        ];
    }
}
