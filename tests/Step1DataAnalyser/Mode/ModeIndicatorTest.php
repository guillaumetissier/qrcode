<?php

namespace Tests\Step1DataAnalyser\Mode;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\Mode;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeIndicator;

class ModeIndicatorTest extends TestCase
{
    private ModeIndicator $indicator;

    public function setUp(): void
    {
        $this->indicator = new ModeIndicator($this->createMock(IOLoggerInterface::class));
    }

    /**
     * @dataProvider provideDataToGetModeIndicator
     */
    public function testGetModeIndicator(Mode $mode, string $expectedModeIndicator): void
    {
        $this->assertSame($expectedModeIndicator, $this->indicator->setMode($mode)->getModeIndicator());
    }

    public static function provideDataToGetModeIndicator(): array
    {
        return [
            [Mode::ALPHANUMERIC, '0010'],
            [Mode::BYTE, '0100'],
            [Mode::NUMERIC, '0001'],
        ];
    }

    public function testGetTotalBits(): void
    {
        $this->assertEquals(4, ModeIndicator::GetTotalBits());
    }
}
