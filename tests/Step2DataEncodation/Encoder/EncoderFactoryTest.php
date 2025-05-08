<?php

namespace Tests\Step2DataEncodation\Encoder;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\AlphanumericEncoder;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\ByteEncoder;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\NumericEncoder;

class EncoderFactoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->factory = new EncoderFactory($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @dataProvider provideDataToGetEncoder
     */
    public function testGetEncoder(Mode $mode, string $expectedEncoderClass): void
    {
        $this->assertInstanceOf($expectedEncoderClass, $this->factory->getEncoder($mode));
    }

    public static function provideDataToGetEncoder(): array
    {
        return [
            [Mode::ALPHANUMERIC, AlphanumericEncoder::class],
            [Mode::BYTE, ByteEncoder::class],
            [Mode::NUMERIC, NumericEncoder::class],
        ];
    }
}
