<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\BitString\CharCountIndicator;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

class CharCountIndicatorTest extends TestCase
{
    /**
     * @dataProvider dataToString
     */
    public function testToString(Mode $mode, Version $version, int $charCount, string $expected): void
    {
        $this->assertEquals(
            $expected,
            CharCountIndicator::create(null, $mode, $version, $charCount)->bitString()->toString()
        );
    }

    public static function dataToString(): \Generator
    {
        yield 'Numeric V01' => [Mode::NUMERIC, Version::V01, 10, '0000001010'];
        yield 'Numeric V09' => [Mode::NUMERIC, Version::V09, 182, '0010110110'];
        yield 'Numeric V10' => [Mode::NUMERIC, Version::V10, 216, '000011011000'];
        yield 'Numeric V26' => [Mode::NUMERIC, Version::V26, 1062, '010000100110'];
        yield 'Numeric V27' => [Mode::NUMERIC, Version::V27, 1128, '00010001101000'];
        yield 'Numeric V40' => [Mode::NUMERIC, Version::V40, 2334, '00100100011110'];

        yield 'Alphanumeric V01' => [Mode::ALPHANUMERIC, Version::V01, 10, '000001010'];
        yield 'Alphanumeric V09' => [Mode::ALPHANUMERIC, Version::V09, 182, '010110110'];
        yield 'Alphanumeric V10' => [Mode::ALPHANUMERIC, Version::V10, 216, '00011011000'];
        yield 'Alphanumeric V26' => [Mode::ALPHANUMERIC, Version::V26, 1062, '10000100110'];
        yield 'Alphanumeric V27' => [Mode::ALPHANUMERIC, Version::V27, 1128, '0010001101000'];
        yield 'Alphanumeric V40' => [Mode::ALPHANUMERIC, Version::V40, 2334, '0100100011110'];

        yield 'Byte V01' => [Mode::BYTE, Version::V01, 10, '00001010'];
        yield 'Byte V09' => [Mode::BYTE, Version::V09, 182, '10110110'];
        yield 'Byte V10' => [Mode::BYTE, Version::V10, 216, '0000000011011000'];
        yield 'Byte V26' => [Mode::BYTE, Version::V26, 1062, '0000010000100110'];
        yield 'Byte V27' => [Mode::BYTE, Version::V27, 1128, '0000010001101000'];
        yield 'Byte V40' => [Mode::BYTE, Version::V40, 2334, '0000100100011110'];
    }

    /**
     * @dataProvider dataBitCount
     */
    public function testBitCount(Mode $mode, Version $version, int $charCount, int $expected): void
    {
        $this->assertEquals(
            $expected,
            CharCountIndicator::create(null, $mode, $version, $charCount)->bitString()->bitCount()
        );
    }

    public static function dataBitCount(): \Generator
    {
        yield 'Numeric V01' => [Mode::NUMERIC, Version::V01, 10, 10];
        yield 'Numeric V09' => [Mode::NUMERIC, Version::V09, 182, 10];
        yield 'Numeric V10' => [Mode::NUMERIC, Version::V10, 216, 12];
        yield 'Numeric V26' => [Mode::NUMERIC, Version::V26, 1062, 12];
        yield 'Numeric V27' => [Mode::NUMERIC, Version::V27, 1128, 14];
        yield 'Numeric V40' => [Mode::NUMERIC, Version::V40, 2334, 14];

        yield 'Alphanumeric V01' => [Mode::ALPHANUMERIC, Version::V01, 10, 9];
        yield 'Alphanumeric V09' => [Mode::ALPHANUMERIC, Version::V09, 182, 9];
        yield 'Alphanumeric V10' => [Mode::ALPHANUMERIC, Version::V10, 216, 11];
        yield 'Alphanumeric V26' => [Mode::ALPHANUMERIC, Version::V26, 1062, 11];
        yield 'Alphanumeric V27' => [Mode::ALPHANUMERIC, Version::V27, 1128, 13];
        yield 'Alphanumeric V40' => [Mode::ALPHANUMERIC, Version::V40, 2334, 13];

        yield 'Byte V01' => [Mode::BYTE, Version::V01, 10, 8];
        yield 'Byte V09' => [Mode::BYTE, Version::V09, 182, 8];
        yield 'Byte V10' => [Mode::BYTE, Version::V10, 216, 16];
        yield 'Byte V26' => [Mode::BYTE, Version::V26, 1062, 16];
        yield 'Byte V27' => [Mode::BYTE, Version::V27, 1128, 16];
        yield 'Byte V40' => [Mode::BYTE, Version::V40, 2334, 16];
    }
}
