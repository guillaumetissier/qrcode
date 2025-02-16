<?php

namespace Tests\DataEncoder\Encoder;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Encoder\AlphanumericEncoder;
use ThePhpGuild\QrCode\DataEncoder\Encoder\ByteEncoder;
use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Encoder\NumericEncoder;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;

class EncoderFactoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->factory = new EncoderFactory();
    }

    /**
     * @dataProvider dataProviderGetEncoder
     */
    public function testGetEncoder(Mode $mode, string $expectedEncoderClass): void
    {
        $this->assertInstanceOf($expectedEncoderClass, $this->factory->getEncoder($mode));
    }

    public static function dataProviderGetEncoder(): array
    {
        return [
            [Mode::ALPHANUMERIC, AlphanumericEncoder::class],
            [Mode::BYTE, ByteEncoder::class],
            [Mode::NUMERIC, NumericEncoder::class],
        ];
    }
}
