<?php

namespace Tests\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;

class ByteCciBitsCounterTest extends LoggerTestCase
{
    private ByteCciBitsCounter $cciBitsCounter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cciBitsCounter = new ByteCciBitsCounter($this->logger);
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
            [Version::V01, 8],
            [Version::V09, 8],
            [Version::V10, 16],
            [Version::V40, 16],
        ];
    }
}
