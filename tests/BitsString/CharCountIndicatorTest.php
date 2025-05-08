<?php

namespace Tests\BitsString;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\CharCountIndicator;
use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Enums\Version;

class CharCountIndicatorTest extends TestCase
{
    private CharCountIndicator $charCountIndicator;

    public function setUp(): void
    {
        $this->charCountIndicator = new CharCountIndicator();
    }

    /**
     * @dataProvider provideDataToTestToString
     */
    public function testToString(Mode $mode, Version $version, int $charCount, string $expected): void
    {
        $cci = $this->charCountIndicator->setMode($mode)->setVersion($version)->setCharCount($charCount);
        $this->assertEquals($expected, "$cci");
    }

    public static function provideDataToTestToString(): \Generator
    {
        yield [Mode::NUMERIC, Version::V01, 10, '0000001010'];
        yield [Mode::NUMERIC, Version::V09, 182, '0010110110'];
        yield [Mode::NUMERIC, Version::V10, 216, '000011011000'];
        yield [Mode::NUMERIC, Version::V26, 1062, '010000100110'];
        yield [Mode::NUMERIC, Version::V27, 1128, '00010001101000'];
        yield [Mode::NUMERIC, Version::V40, 2334, '00100100011110'];

        yield [Mode::ALPHANUMERIC, Version::V01, 10, '000001010'];
        yield [Mode::ALPHANUMERIC, Version::V09, 182, '010110110'];
        yield [Mode::ALPHANUMERIC, Version::V10, 216, '00011011000'];
        yield [Mode::ALPHANUMERIC, Version::V26, 1062, '10000100110'];
        yield [Mode::ALPHANUMERIC, Version::V27, 1128, '0010001101000'];
        yield [Mode::ALPHANUMERIC, Version::V40, 2334, '0100100011110'];

        yield [Mode::BYTE, Version::V01, 10, '00001010'];
        yield [Mode::BYTE, Version::V09, 182, '10110110'];
        yield [Mode::BYTE, Version::V10, 216, '0000000011011000'];
        yield [Mode::BYTE, Version::V26, 1062, '0000010000100110'];
        yield [Mode::BYTE, Version::V27, 1128, '0000010001101000'];
        yield [Mode::BYTE, Version::V40, 2334, '0000100100011110'];
    }

    /**
     * @dataProvider provideDataToTestGetBitsCount
     */
    public function testBitsCount(Mode $mode, Version $version, int $expected): void
    {
        $this->assertEquals($expected, $this->charCountIndicator->setMode($mode)->setVersion($version)->bitsCount());
    }

    public static function provideDataToTestGetBitsCount(): \Generator
    {
        yield [Mode::NUMERIC, Version::V01, 10];
        yield [Mode::NUMERIC, Version::V09, 10];
        yield [Mode::NUMERIC, Version::V10, 12];
        yield [Mode::NUMERIC, Version::V26, 12];
        yield [Mode::NUMERIC, Version::V27, 14];
        yield [Mode::NUMERIC, Version::V40, 14];

        yield [Mode::ALPHANUMERIC, Version::V01, 9];
        yield [Mode::ALPHANUMERIC, Version::V09, 9];
        yield [Mode::ALPHANUMERIC, Version::V10, 11];
        yield [Mode::ALPHANUMERIC, Version::V26, 11];
        yield [Mode::ALPHANUMERIC, Version::V27, 13];
        yield [Mode::ALPHANUMERIC, Version::V40, 13];

        yield [Mode::BYTE, Version::V01, 8];
        yield [Mode::BYTE, Version::V09, 8];
        yield [Mode::BYTE, Version::V10, 16];
        yield [Mode::BYTE, Version::V26, 16];
        yield [Mode::BYTE, Version::V27, 16];
        yield [Mode::BYTE, Version::V40, 16];
    }
}