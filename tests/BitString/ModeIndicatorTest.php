<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\BitString\ModeIndicator;
use Guillaumetissier\QrCode\Enums\Mode;

class ModeIndicatorTest extends TestCase
{
    /**
     * @dataProvider provideDataToToString
     */
    public function testToString(Mode $mode, string $expectedModeIndicator): void
    {
        $this->assertEquals($expectedModeIndicator, ModeIndicator::create($mode)->bitString()->toString());
    }

    public static function provideDataToToString(): array
    {
        return [
            [Mode::ALPHANUMERIC, '0010'],
            [Mode::BYTE, '0100'],
            [Mode::NUMERIC, '0001'],
        ];
    }
}
