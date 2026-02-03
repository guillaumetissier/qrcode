<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\AlphanumericEncoder;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

class AlphanumericEncoderTest extends BaseEncoderTestCase
{
    public function setUp(): void
    {
        $this->encoder = new AlphanumericEncoder($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @return array<array{string, string}>
     */
    public static function provideDataToEncode(): array
    {
        return [
            [
                'HELLO WORLD',
                '
                01100001011 01111000110
                10001011100 10110111000
                10011010100 001101
                '
            ],
            [
                'HOW ARE YOU TODAY...',
                '
                01100010101 10111000100
                00111011101 01010011010
                11000010010 10101101010
                10100110001 01001010011
                11000100100 11110001100
                '
            ]
        ];
    }
}
