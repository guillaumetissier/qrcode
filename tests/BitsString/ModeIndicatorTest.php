<?php

namespace Tests\BitsString;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\ModeIndicator;
use ThePhpGuild\QrCode\Enums\Mode;

class ModeIndicatorTest extends TestCase
{
    private ModeIndicator $indicator;

    public function setUp(): void
    {
        $this->indicator = new ModeIndicator();
    }

    /**
     * @dataProvider provideDataToToString
     */
    public function testToString(Mode $mode, string $expectedModeIndicator): void
    {
        $modeIndicator = $this->indicator->setMode($mode);

        $this->assertEquals($expectedModeIndicator, "$modeIndicator");
    }

    public static function provideDataToToString(): array
    {
        return [
            [Mode::ALPHANUMERIC, '0010'],
            [Mode::BYTE, '0100'],
            [Mode::NUMERIC, '0001'],
        ];
    }

    public function testBitsCount(): void
    {
        $this->assertEquals(4, $this->indicator->bitsCount());
    }
}
