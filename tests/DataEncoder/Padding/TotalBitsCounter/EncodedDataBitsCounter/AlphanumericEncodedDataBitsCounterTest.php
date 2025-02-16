<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\AlphanumericEncodedDataBitsCounter;

class AlphanumericEncodedDataBitsCounterTest extends TestCase
{
    private AlphanumericEncodedDataBitsCounter $counter;

    public function setUp(): void
    {
        $this->counter = new AlphanumericEncodedDataBitsCounter();
    }

    /**
     * @dataProvider provideDataToCount
     */
    public function testCount(int $dataLength, int $expectedTotalBits): void
    {
        $this->assertEquals($expectedTotalBits, $this->counter->setDataLength($dataLength)->count());
    }

    public static function provideDataToCount(): array
    {
        return [
            [27, 149],
            [69, 380],
            [157, 864],
            [240, 1320],
            [382, 2101],
            [1387, 7629],
            [1875, 10313],
            [3030, 16665],
            [3159, 17375],
            [4219, 23205],
        ];
    }

}
