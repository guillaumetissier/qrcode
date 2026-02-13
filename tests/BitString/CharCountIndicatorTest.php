<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\BitString\CharCountIndicator;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

class CharCountIndicatorTest extends TestCase
{
    /**
     * @param Mode $mode
     * @param Version $version
     * @param string $data
     * @param string $expected
     * @return void
     *
     * @throws MissingInfoException
     *
     * @dataProvider dataToString
     */
    public function testToString(Mode $mode, Version $version, string $data, string $expected): void
    {
        $this->assertEquals(
            $expected,
            CharCountIndicator::create()
                ->withVersion($version)
                ->withMode($mode)
                ->withData($data)
                ->bitString()
                ->toString()
        );
    }

    public static function dataToString(): \Generator
    {
        yield 'Numeric V01' => [Mode::NUMERIC, Version::V01, self::randomString(10), '0000001010'];
        yield 'Numeric V09' => [Mode::NUMERIC, Version::V09, self::randomString(182), '0010110110'];
        yield 'Numeric V10' => [Mode::NUMERIC, Version::V10, self::randomString(216), '000011011000'];
        yield 'Numeric V26' => [Mode::NUMERIC, Version::V26, self::randomString(1062), '010000100110'];
        yield 'Numeric V27' => [Mode::NUMERIC, Version::V27, self::randomString(1128), '00010001101000'];
        yield 'Numeric V40' => [Mode::NUMERIC, Version::V40, self::randomString(2334), '00100100011110'];

        yield 'Alphanumeric V01' => [Mode::ALPHANUMERIC, Version::V01, self::randomString(10), '000001010'];
        yield 'Alphanumeric V09' => [Mode::ALPHANUMERIC, Version::V09, self::randomString(182), '010110110'];
        yield 'Alphanumeric V10' => [Mode::ALPHANUMERIC, Version::V10, self::randomString(216), '00011011000'];
        yield 'Alphanumeric V26' => [Mode::ALPHANUMERIC, Version::V26, self::randomString(1062), '10000100110'];
        yield 'Alphanumeric V27' => [Mode::ALPHANUMERIC, Version::V27, self::randomString(1128), '0010001101000'];
        yield 'Alphanumeric V40' => [Mode::ALPHANUMERIC, Version::V40, self::randomString(2334), '0100100011110'];

        yield 'Byte V01' => [Mode::BYTE, Version::V01, self::randomString(10), '00001010'];
        yield 'Byte V09' => [Mode::BYTE, Version::V09, self::randomString(182), '10110110'];
        yield 'Byte V10' => [Mode::BYTE, Version::V10, self::randomString(216), '0000000011011000'];
        yield 'Byte V26' => [Mode::BYTE, Version::V26, self::randomString(1062), '0000010000100110'];
        yield 'Byte V27' => [Mode::BYTE, Version::V27, self::randomString(1128), '0000010001101000'];
        yield 'Byte V40' => [Mode::BYTE, Version::V40, self::randomString(2334), '0000100100011110'];
    }

    /**
     * @param Mode $mode
     * @param Version $version
     * @param string $data
     * @param int $expected
     * @return void
     *
     * @throws MissingInfoException
     *
     * @dataProvider dataBitCount
     */
    public function testBitCount(Mode $mode, Version $version, string $data, int $expected): void
    {
        $this->assertEquals(
            $expected,
            CharCountIndicator::create()
                ->withVersion($version)
                ->withMode($mode)
                ->withData($data)
                ->bitString()
                ->bitCount()
        );
    }

    public static function dataBitCount(): \Generator
    {
        yield 'Numeric V01' => [Mode::NUMERIC, Version::V01, self::randomString(10), 10];
        yield 'Numeric V09' => [Mode::NUMERIC, Version::V09, self::randomString(182), 10];
        yield 'Numeric V10' => [Mode::NUMERIC, Version::V10, self::randomString(216), 12];
        yield 'Numeric V26' => [Mode::NUMERIC, Version::V26, self::randomString(1062), 12];
        yield 'Numeric V27' => [Mode::NUMERIC, Version::V27, self::randomString(1128), 14];
        yield 'Numeric V40' => [Mode::NUMERIC, Version::V40, self::randomString(2334), 14];

        yield 'Alphanumeric V01' => [Mode::ALPHANUMERIC, Version::V01, self::randomString(10), 9];
        yield 'Alphanumeric V09' => [Mode::ALPHANUMERIC, Version::V09, self::randomString(182), 9];
        yield 'Alphanumeric V10' => [Mode::ALPHANUMERIC, Version::V10, self::randomString(216), 11];
        yield 'Alphanumeric V26' => [Mode::ALPHANUMERIC, Version::V26, self::randomString(1062), 11];
        yield 'Alphanumeric V27' => [Mode::ALPHANUMERIC, Version::V27, self::randomString(1128), 13];
        yield 'Alphanumeric V40' => [Mode::ALPHANUMERIC, Version::V40, self::randomString(2334), 13];

        yield 'Byte V01' => [Mode::BYTE, Version::V01, self::randomString(10), 8];
        yield 'Byte V09' => [Mode::BYTE, Version::V09, self::randomString(182), 8];
        yield 'Byte V10' => [Mode::BYTE, Version::V10, self::randomString(216), 16];
        yield 'Byte V26' => [Mode::BYTE, Version::V26, self::randomString(1062), 16];
        yield 'Byte V27' => [Mode::BYTE, Version::V27, self::randomString(1128), 16];
        yield 'Byte V40' => [Mode::BYTE, Version::V40, self::randomString(2334), 16];
    }

    private static function randomString(int $length): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $result = '';

        for ($i = 0; $i < $length; $i++) {
            $result .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $result;
    }
}
