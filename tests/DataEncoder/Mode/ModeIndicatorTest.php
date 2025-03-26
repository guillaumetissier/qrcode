<?php

namespace Tests\DataEncoder\Mode;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

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
