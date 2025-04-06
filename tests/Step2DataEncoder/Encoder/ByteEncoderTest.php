<?php

namespace Tests\Step2DataEncoder\Encoder;

use ThePhpGuild\QrCode\Step2DataEncoder\Encoder\ByteEncoder;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class ByteEncoderTest extends BaseEncoderTestCase
{
    public function setUp(): void
    {
        $this->encoder = new ByteEncoder($this->createMock(IOLoggerInterface::class));
    }

    public static function provideDataToEncode(): array
    {
        return [
            [
                'http://qr-code?mode=byte&data=hello',
                '
                01101000 01110100 01110100 01110000 00111010 00101111 00101111
                01110001 01110010 00101101 01100011 01101111 01100100 01100101 
                00111111 01101101 01101111 01100100 01100101 00111101 01100010
                01111001 01110100 01100101 00100110 01100100 01100001 01110100
                01100001 00111101 01101000 01100101 01101100 01101100 01101111
                '
            ]
        ];
    }
}
