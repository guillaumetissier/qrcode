<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Common\Position;
use PHPUnit\Framework\TestCase;

final class BitMatrixTest extends TestCase
{
    private BitMatrix $matrix;

    public function setUp(): void
    {
        $this->matrix = BitMatrix::fromArray(
            [
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 1, 2, 0, 0],
                [0, 0, 3, 4, 5, 0, 0],
                [0, 0, 6, 7, 8, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0, 0, 0],
            ],
            2
        );
    }

    /**
     * @param int $size
     * @param int $margin
     * @param string $expected
     * @return void
     *
     * @dataProvider dataEmpty
     */
    public function testEmpty(int $size, int $margin, string $expected): void
    {
        $nulls = BitMatrix::empty($size, $margin);
        $this->assertSame($expected, $nulls->showValues()->toString(true));
        $this->assertSame($expected, BitMatrix::fromMatrix($nulls)->showValues()->toString(true));
    }

    public static function dataEmpty(): \Generator
    {
        yield [
            3,
            0,
            "..." . PHP_EOL .
            "..." . PHP_EOL .
            "..." . PHP_EOL
        ];
        yield [
            3,
            1,
            "00000" . PHP_EOL .
            "0...0" . PHP_EOL .
            "0...0" . PHP_EOL .
            "0...0" . PHP_EOL .
            "00000" . PHP_EOL
        ];
        yield [
            3,
            4,
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "0000...0000" . PHP_EOL .
            "0000...0000" . PHP_EOL .
            "0000...0000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL
        ];
    }

    /**
     * @param int $size
     * @param int $margin
     * @param string $expected
     * @return void
     *
     * @dataProvider dataZeros
     */
    public function testZeros(int $size, int $margin, string $expected): void
    {
        $zeros = BitMatrix::zeros($size, $margin);
        $this->assertSame($expected, $zeros->showValues()->toString(true));
        $this->assertSame($expected, BitMatrix::fromMatrix($zeros)->showValues()->toString(true));
    }

    public static function dataZeros(): \Generator
    {
        yield [
            3,
            0,
            "000" . PHP_EOL .
            "000" . PHP_EOL .
            "000" . PHP_EOL
        ];
        yield [
            3,
            1,
            "00000" . PHP_EOL .
            "00000" . PHP_EOL .
            "00000" . PHP_EOL .
            "00000" . PHP_EOL .
            "00000" . PHP_EOL
        ];
        yield [
            3,
            4,
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL
        ];
    }

    /**
     * @param int $size
     * @param int $margin
     * @param string $expected
     * @return void
     *
     * @dataProvider dataOnes
     */
    public function testOnes(int $size, int $margin, string $expected): void
    {
        $ones = BitMatrix::ones($size, $margin);
        $this->assertSame($expected, $ones->showValues()->toString(true));
        $this->assertSame($expected, BitMatrix::fromMatrix($ones)->showValues()->toString(true));
    }

    public static function dataOnes(): \Generator
    {
        yield [
            3,
            0,
            "111" . PHP_EOL .
            "111" . PHP_EOL .
            "111" . PHP_EOL
        ];
        yield [
            3,
            1,
            "00000" . PHP_EOL .
            "01110" . PHP_EOL .
            "01110" . PHP_EOL .
            "01110" . PHP_EOL .
            "00000" . PHP_EOL
        ];
        yield [
            3,
            4,
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00001110000" . PHP_EOL .
            "00001110000" . PHP_EOL .
            "00001110000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL .
            "00000000000" . PHP_EOL
        ];
    }

    /**
     * @param bool $marginIncluded
     * @param int $expectedSize
     * @return void
     *
     * @dataProvider dataSize
     */
    public function testSize(bool $marginIncluded, int $expectedSize): void
    {
        $this->assertEquals($expectedSize, $this->matrix->size($marginIncluded));
    }

    /**
     * @return array<array{bool, int}>
     */
    public static function dataSize(): array
    {
        return [
            [false, 3],
            [true, 7],
        ];
    }

    /**
     * @param bool $marginIncluded
     * @param int[][] $expected
     * @return void
     *
     * @dataProvider dataToArray
     */
    public function testToArray(bool $marginIncluded, array $expected): void
    {
        $this->assertEquals($expected, $this->matrix->toArray($marginIncluded));
    }

    /**
     * @return array<array{bool, int[][]}>
     */
    public static function dataToArray(): array
    {
        return [
            [
                false,
                [
                    [0, 1, 2],
                    [3, 4, 5],
                    [6, 7, 8]
                ]
            ],
            [
                true,
                [
                    [0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 1, 2, 0, 0],
                    [0, 0, 3, 4, 5, 0, 0],
                    [0, 0, 6, 7, 8, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0],
                    [0, 0, 0, 0, 0, 0, 0],
                ]
            ],
        ];
    }

    /**
     * @param bool $marginIncluded
     * @param string $expected
     * @return void
     *
     * @dataProvider dataToString
     */
    public function testToString(bool $marginIncluded, string $expected): void
    {
        $this->assertEquals($expected, $this->matrix->showValues()->toString($marginIncluded));
    }

    /**
     * @return array<array{bool, string}>
     */
    public static function dataToString(): array
    {
        return [
            [
                false,
                "012" . PHP_EOL .
                "345" . PHP_EOL .
                "678" . PHP_EOL,
            ],
            [
                true,
                "0000000" . PHP_EOL .
                "0000000" . PHP_EOL .
                "0001200" . PHP_EOL .
                "0034500" . PHP_EOL .
                "0067800" . PHP_EOL .
                "0000000" . PHP_EOL .
                "0000000" . PHP_EOL,
            ],
        ];
    }

    /**
     * @dataProvider dataGetValueFromTopLeft
     */
    public function testGetValueFromTopLeft(int $row, int $col, int $expected): void
    {
        $this->assertEquals($expected, $this->matrix->value($row, $col));
    }

    public static function dataGetValueFromTopLeft(): \Generator
    {
        yield [0, 0, 0];
        yield [0, 1, 1];
        yield [0, 2, 2];
        yield [1, 0, 3];
        yield [1, 1, 4];
        yield [1, 2, 5];
        yield [2, 0, 6];
        yield [2, 1, 7];
        yield [2, 2, 8];
    }

    /**
     * @param int $row
     * @param int $col
     * @param int $value
     * @param int[][] $expected
     * @return void
     * @dataProvider dataSetValue
     */
    public function testSetValue(int $row, int $col, int $value, array $expected): void
    {
        $this->assertEquals(
            $expected,
            $this->matrix->setValue(Position::fromTopLeft($col, $row), $value)->toArray(false)
        );
    }

    public static function dataSetValue(): \Generator
    {
        yield [0, 0, 9, [[9, 1, 2], [3, 4, 5], [6, 7, 8]]];
        yield [0, 1, 9, [[0, 9, 2], [3, 4, 5], [6, 7, 8]]];
        yield [0, 2, 9, [[0, 1, 9], [3, 4, 5], [6, 7, 8]]];
        yield [1, 0, 9, [[0, 1, 2], [9, 4, 5], [6, 7, 8]]];
        yield [1, 1, 9, [[0, 1, 2], [3, 9, 5], [6, 7, 8]]];
        yield [1, 2, 9, [[0, 1, 2], [3, 4, 9], [6, 7, 8]]];
        yield [2, 0, 9, [[0, 1, 2], [3, 4, 5], [9, 7, 8]]];
        yield [2, 1, 9, [[0, 1, 2], [3, 4, 5], [6, 9, 8]]];
        yield [2, 2, 9, [[0, 1, 2], [3, 4, 5], [6, 7, 9]]];
    }
}
