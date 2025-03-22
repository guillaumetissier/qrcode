<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

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
