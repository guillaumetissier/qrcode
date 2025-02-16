<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\NumericEncodedDataBitsCounter;

class NumericEncodedDataBitsCounterTest extends TestCase
{
    private NumericEncodedDataBitsCounter $counter;

    public function setUp(): void
    {
        $this->counter = new NumericEncodedDataBitsCounter();
    }

    /**
     * @dataProvider providerCount
     */
    public function testCount(int $dataLength, int $expectedTotalBits): void
    {
        $this->assertEquals($expectedTotalBits, $this->counter->setDataLength($dataLength)->count());
    }

    public static function providerCount(): array
    {
        return [
            [27, 90],
            [69, 230],
            [157, 524],
            [240, 800],
            [382, 1274],
            [1387, 4624],
            [1875, 6250],
            [3030, 10100],
            [3161, 10537],
            [4219, 14064],
        ];
    }
}
