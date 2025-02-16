<?php

namespace Tests\DataEncoder\Padding;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\LengthBitsInterface;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class PaddingAppenderTest extends TestCase
{
    /**
     * @throws Exception
     * @dataProvider dataProviderAppendPadding
     */
    public function testAppendPadding(
        string $data,
        Version $version,
        Mode $mode,
        int $returnTotalBits,
        string $returnModeIndicator,
        string $returnLengthBits,
        string $expectedPaddedData
    ): void
    {
        $dataLength = strlen($data);
        $paddingAppender = new PaddingAppender(
            $this->getTotalBitsCounterBuilder($dataLength, $version, $returnTotalBits),
            $this->getModeIndicator($mode, $returnModeIndicator),
            $this->getLengthBitsFactory($mode, $dataLength, $version, $returnLengthBits)
        );
        $this->assertEquals(
            $expectedPaddedData,
            $paddingAppender->setData($data)->setVersion($version)->setMode($mode)->appendPadding()
        );
    }

    public static function dataProviderAppendPadding(): array
    {
        return [
            [
                '123456789098765432101234567890',
                Version::V03,
                Mode::NUMERIC,
                100,
                '0001',
                '0001100100',
                '00010001100100123456789098765432101234567890000000000000000000000000000000000000000000000000000000000000'
            ]
        ];
    }

    /**
     * @throws Exception
     */
    private function getTotalBitsCounterBuilder(
        int $datLength,
        Version $version,
        int $returnTotalBits
    ) : TotalBitsCounterBuilder
    {
        $totalBitsCounter = $this->createMock(TotalBitsCounter::class);
        $totalBitsCounter->method('setDataLength')->with($datLength)->willReturnSelf();
        $totalBitsCounter->method('setVersion')->with($version)->willReturnSelf();
        $totalBitsCounter->method('count')->willReturn($returnTotalBits);

        $totalBitsCounterBuilder = $this->createMock(TotalBitsCounterBuilder::class);
        $totalBitsCounterBuilder->method('getTotalBitsCounter')->willReturn($totalBitsCounter);

        return $totalBitsCounterBuilder;
    }

    /**
     * @throws Exception
     */
    private function getModeIndicator(Mode $mode, string $returnModeIndicator): ModeIndicator
    {
        $modeIndicator = $this->createMock(ModeIndicator::class);
        $modeIndicator->method('setMode')->with($mode)->willReturnSelf();
        $modeIndicator->method('getModeIndicator')->willReturn($returnModeIndicator);

        return $modeIndicator;
    }

    /**
     * @throws Exception
     */
    private function getLengthBitsFactory(
        Mode $mode,
        int $dataLength,
        Version $version,
        string $returnLengthBits
    ): LengthBitsFactory
    {
        $lengthBits = $this->createMock(LengthBitsInterface::class);
        $lengthBits->method('setDataLength')->with($dataLength)->willReturnSelf();
        $lengthBits->method('setVersion')->with($version)->willReturnSelf();
        $lengthBits->method('getLengthBits')->willReturn($returnLengthBits);

        $lengthBitsFactory = $this->createMock(LengthBitsFactory::class);
        $lengthBitsFactory->method('getLengthBits')->with($mode)->willReturn($lengthBits);

        return $lengthBitsFactory;
    }
}
