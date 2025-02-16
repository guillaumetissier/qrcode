<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\AlphanumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\ByteCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\NumericCciBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\AlphanumericEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\ByteEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\NumericEncodedDataBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;

class TotalBitsCounterBuilderTest extends TestCase
{
    private TotalBitsCounterBuilder $totalBitsCounterBuilder;

    public function setUp(): void
    {
        $this->totalBitsCounterBuilder = new TotalBitsCounterBuilder();
    }

    /**
     * @dataProvider provideDataToBuild
     */
    public function testBuild(Mode $mode, string $cciBitsCounterClass, string $encodedDataBitsCounterClass): void
    {
        $totalBitsCounter = $this->totalBitsCounterBuilder->getTotalBitsCounter($mode);
        $this->assertInstanceOf(TotalBitsCounter::class, $totalBitsCounter);

        $reflection = new \ReflectionClass($totalBitsCounter);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
        $this->assertInstanceOf($cciBitsCounterClass, $properties[2]->getValue($totalBitsCounter));
        $this->assertInstanceOf($encodedDataBitsCounterClass, $properties[3]->getValue($totalBitsCounter));
    }

    public static function provideDataToBuild(): array
    {
        return [
            [Mode::ALPHANUMERIC, AlphanumericCciBitsCounter::class, AlphanumericEncodedDataBitsCounter::class],
            [Mode::BYTE, ByteCciBitsCounter::class, ByteEncodedDataBitsCounter::class],
            [Mode::NUMERIC, NumericCciBitsCounter::class, NumericEncodedDataBitsCounter::class],
        ];
    }
}
