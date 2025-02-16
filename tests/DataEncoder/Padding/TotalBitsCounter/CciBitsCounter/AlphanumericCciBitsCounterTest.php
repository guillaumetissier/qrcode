<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\AlphanumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class AlphanumericCciBitsCounterTest extends TestCase
{
    private AlphanumericCciBitsCounter $cciBitsCounter;

    protected function setUp(): void
    {
        $this->cciBitsCounter = new AlphanumericCciBitsCounter();
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
            [Version::V01, 9],
            [Version::V09, 9],
            [Version::V10, 11],
            [Version::V26, 11],
            [Version::V27, 13],
            [Version::V40, 13],
        ];
    }
}
