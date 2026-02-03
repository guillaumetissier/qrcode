<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\ModeEncoder;

use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\AlphanumericEncoder;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ByteEncoder;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\NumericEncoder;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

class ModeEncoderFactoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->factory = ModeEncoderFactory::create($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @dataProvider provideDataToGetEncoder
     */
    public function testGetEncoder(Mode $mode, string $expectedEncoderClass): void
    {
        $this->assertInstanceOf($expectedEncoderClass, $this->factory->getModeEncoder($mode));
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
