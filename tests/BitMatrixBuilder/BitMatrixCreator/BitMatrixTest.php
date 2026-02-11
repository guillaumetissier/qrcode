<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Common\Position;
use PHPUnit\Framework\TestCase;

class BitMatrixTest extends TestCase
{
    private BitMatrix $matrix;

    public function setUp(): void
    {
        $this->matrix = BitMatrix::fromArray([
            [0, 1, 2],
            [3, 4, 5],
            [6, 7, 8],
        ]);
    }

    public function testGetSize(): void
    {
        $this->assertEquals(3, $this->matrix->size());
    }

    public function testToArray(): void
    {
        $this->assertEquals([[0, 1, 2], [3, 4, 5], [6, 7, 8]], $this->matrix->toArray());
    }

    public function testToString(): void
    {
        $this->assertEquals(
            "012" . PHP_EOL .
            "345" . PHP_EOL .
            "678" . PHP_EOL,
            $this->matrix->showValues()->__toString()
        );
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
     * @param list<list<int>> $expected
     * @return void
     * @dataProvider dataSetValue
     */
    public function testSetValue(int $row, int $col, int $value, array $expected): void
    {
        $this->assertEquals($expected, $this->matrix->setValue(Position::fromTopLeft($col, $row), $value)->toArray());
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
