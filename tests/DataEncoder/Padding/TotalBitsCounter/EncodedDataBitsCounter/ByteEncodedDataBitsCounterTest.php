<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;

class ByteEncodedDataBitsCounterTest extends LoggerTestCase
{
    private ByteEncodedDataBitsCounter $counter;

    public function setUp(): void
    {
        parent::setUp();

        $this->counter = new ByteEncodedDataBitsCounter($this->logger);
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
