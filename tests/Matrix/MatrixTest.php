<?php

namespace Tests\Matrix;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;

class MatrixTest extends TestCase
{
    private Matrix $matrix;

    public function setUp(): void
    {
        $this->matrix = new Matrix([
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
        ]);
    }

    public function testGetSize(): void
    {
        $this->assertEquals(3, $this->matrix->getSize());
    }

    public function testToArray(): void
    {
        $this->assertEquals([[0, 1, 2], [3, 4, 5], [6, 7, 8]], $this->matrix->toArray());
    }

    public function testToString(): void
    {
        $this->assertEquals(
            " ██".PHP_EOL.
            "███".PHP_EOL.
            "███".PHP_EOL,
            "{$this->matrix}"
        );
    }

    /**
     * @dataProvider provideDataToTestGetValueFromTopLeft
     */
    public function testGetValueFromTopLeft(int $row, int $col, int $expected): void
    {
        $this->assertEquals($expected, $this->matrix->getValueFromTopLeft($row, $col));
    }

    public static function provideDataToTestGetValueFromTopLeft(): \Generator
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
     * @dataProvider provideDataToTestGetValueFromBottomRight
     */
    public function testGetValueFromBottomRight(int $row, int $col, int $expected): void
    {
        $this->assertEquals($expected, $this->matrix->getValueFromBottomRight($row, $col));
    }

    public static function provideDataToTestGetValueFromBottomRight(): \Generator
    {
        yield [0, 0, 8];
        yield [0, 1, 7];
        yield [0, 2, 6];
        yield [1, 0, 5];
        yield [1, 1, 4];
        yield [1, 2, 3];
        yield [2, 0, 2];
        yield [2, 1, 1];
        yield [2, 2, 0];
    }

    /**
     * @dataProvider provideDataToTestSetValueFromTopLeft
     */
    public function testSetValueFromTopLeft(int $row, int $col, int $value, array $expected): void
    {
        $this->assertEquals($expected, $this->matrix->setValueFromTopLeft($row, $col, $value)->toArray());
    }

    public static function provideDataToTestSetValueFromTopLeft(): \Generator
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

    /**
     * @dataProvider provideDataToTestSetValueFromBottomRight
     */
    public function testSetValueFromBottomRight(int $row, int $col, int $value, array $expected): void
    {
        $this->assertEquals($expected, $this->matrix->setValueFromBottomRight($row, $col, $value)->toArray());
    }

    public static function provideDataToTestSetValueFromBottomRight(): \Generator
    {
        yield [0, 0, 9, [[0, 1, 2], [3, 4, 5], [6, 7, 9]]];
        yield [0, 1, 9, [[0, 1, 2], [3, 4, 5], [6, 9, 8]]];
        yield [0, 2, 9, [[0, 1, 2], [3, 4, 5], [9, 7, 8]]];
        yield [1, 0, 9, [[0, 1, 2], [3, 4, 9], [6, 7, 8]]];
        yield [1, 1, 9, [[0, 1, 2], [3, 9, 5], [6, 7, 8]]];
        yield [1, 2, 9, [[0, 1, 2], [9, 4, 5], [6, 7, 8]]];
        yield [2, 0, 9, [[0, 1, 9], [3, 4, 5], [6, 7, 8]]];
        yield [2, 1, 9, [[0, 9, 2], [3, 4, 5], [6, 7, 8]]];
        yield [2, 2, 9, [[9, 1, 2], [3, 4, 5], [6, 7, 8]]];
    }
}
