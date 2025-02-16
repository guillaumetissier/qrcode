<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;

class ByteEncodedDataBitsCounterTest extends TestCase
{
    private ByteEncodedDataBitsCounter $counter;

    public function setUp(): void
    {
        $this->counter = new ByteEncodedDataBitsCounter();
    }

    /**
     * @dataProvider dataProviderCount
     */
    public function testCount(int $dataLength, int $expectedTotalBits): void
    {
        $this->assertEquals($expectedTotalBits, $this->counter->setDataLength($dataLength)->count());
    }

    public static function dataProviderCount(): array
    {
        return [
            [27, 216],
            [69, 552],
            [157, 1256],
            [240, 1920],
            [382, 3056],
            [1387, 11096],
            [1875, 15000],
            [3030, 24240],
            [3159, 25272],
            [4219, 33752],
        ];
    }

}
