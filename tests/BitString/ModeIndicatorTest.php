<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\BitString\ModeIndicator;
use Guillaumetissier\QrCode\Enums\Mode;

class ModeIndicatorTest extends TestCase
{
    /**
     * @param Mode $mode
     * @param string $expectedModeIndicator
     * @return void
     *
     * @throws MissingInfoException
     *
     * @dataProvider provideDataToToString
     */
    public function testToString(Mode $mode, string $expectedModeIndicator): void
    {
        $this->assertEquals(
            $expectedModeIndicator,
            ModeIndicator::create()->withMode($mode)->bitString()->toString()
        );
    }

    /**
     * @return array<array{Mode, string}>
     */
    public static function provideDataToToString(): array
    {
        return [
            [Mode::ALPHANUMERIC, '0010'],
            [Mode::BYTE, '0100'],
            [Mode::NUMERIC, '0001'],
        ];
    }
}
