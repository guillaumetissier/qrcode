<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class ByteCciBitsCounterTest extends TestCase
{
    private ByteCciBitsCounter $cciBitsCounter;

    protected function setUp(): void
    {
        $this->cciBitsCounter = new ByteCciBitsCounter();
    }

    /**
     * @dataProvider dataProviderCount
     */
    public function testCount(Version $version, int $expectedTotal): void
    {
        $this->assertEquals($expectedTotal, $this->cciBitsCounter->setVersion($version)->count());
    }

    public static function dataProviderCount(): array
    {
        return [
            [Version::V01, 8],
            [Version::V09, 8],
            [Version::V10, 16],
            [Version::V40, 16],
        ];
    }
}
