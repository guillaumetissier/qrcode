<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class NumericCciBitsCounterTest extends TestCase
{
    private NumericCciBitsCounter $cciBitsCounter;

    protected function setUp(): void
    {
        $this->cciBitsCounter = new NumericCciBitsCounter();
    }

    /**
     * @dataProvider providerCount
     */
    public function testCount(Version $version, int $expectedTotal): void
    {
        $this->assertEquals($expectedTotal, $this->cciBitsCounter->setVersion($version)->count());
    }

    public static function providerCount(): array
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
