<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\NumericEncoder;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

class NumericEncoderTest extends BaseEncoderTestCase
{
    public function setUp(): void
    {
        $this->encoder = new NumericEncoder($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function provideDataToEncode(): array
    {
        return [
            [
                '0123456789',
                '
                0000001100 0101011001
                1010100110 1001
                '
            ],
            [
                '11122233344455',
                '
                0001101111 0011011110
                0101001101 0110111100
                0110111
                '
            ],
            [
                '666777888999000111',
                '
                1010011010 1100001001
                1101111000 1111100111
                0000000000 0001101111
                '
            ]
        ];
    }
}
