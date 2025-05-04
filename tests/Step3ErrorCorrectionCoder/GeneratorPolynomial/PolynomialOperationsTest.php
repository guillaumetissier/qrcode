<?php

namespace Tests\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\IntegerOperations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Polynomial;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\PolynomialOperations;

class PolynomialOperationsTest extends TestCase
{
    private PolynomialOperations $polynomialOperations;

    public function setUp(): void
    {
        $this->polynomialOperations = new PolynomialOperations(new IntegerOperations());
    }

    /**
     * @dataProvider provideDataToTestAdd
     */
    public function testAdd(Polynomial $p1, Polynomial $p2, string $expected): void
    {
        $actual = $this->polynomialOperations->add($p1, $p2);
        $this->assertEquals($expected, "$actual");
    }

    public static function provideDataToTestAdd(): \Generator
    {
        yield [
            new Polynomial(),
            new Polynomial(),
            '',
        ];
        yield [
            new Polynomial([5, 4, 3, 2, 1]),
            new Polynomial([12, 14, 16, 18, 20]),
            '17.x^4 + 18.x^3 + 19.x^2 + 20.x^1 + 21.x^0',
        ];
        yield [
            new Polynomial([1, 2, 3, 4, 5]),
            new Polynomial([13, 12, 11]),
            '1.x^4 + 2.x^3 + 16.x^2 + 16.x^1 + 16.x^0',
        ];
    }

    /**
     * @dataProvider provideDataToTestSubtract
     */
    public function testSubtract(Polynomial $p1, Polynomial $p2, string $expected): void
    {
        $actual = $this->polynomialOperations->subtract($p1, $p2);
        $this->assertEquals($expected, "$actual");
    }

    public static function provideDataToTestSubtract(): \Generator
    {
        yield [
            new Polynomial(),
            new Polynomial(),
            '',
        ];
        yield [
            new Polynomial([5, 4, 17, 20, 1]),
            new Polynomial([12, 14, 6, 18, 20]),
            '-7.x^4 + -10.x^3 + 11.x^2 + 2.x^1 + -19.x^0',
        ];
        yield [
            new Polynomial([1, 23, 3, 12, 5]),
            new Polynomial([13, 7, 11]),
            '1.x^4 + 23.x^3 + -10.x^2 + 5.x^1 + -6.x^0',
        ];
    }

    /**
     * @dataProvider provideDataToTestMultiply
     */
    public function testMultiply(Polynomial $multiplicand, Polynomial|int|float $multiplier, string $expected): void
    {
        $actual = $this->polynomialOperations->multiply($multiplicand, $multiplier);
        $this->assertEquals($expected, "$actual");
    }

    public static function provideDataToTestMultiply(): \Generator
    {
        yield [
            new Polynomial([1, 3, 5]),
            2,
            '2.x^2 + 6.x^1 + 10.x^0',
        ];
        yield [
            new Polynomial([3, 7, 9]),
            2.5,
            '7.5.x^2 + 17.5.x^1 + 22.5.x^0',
        ];
        yield [
            new Polynomial(),
            new Polynomial(),
            '',
        ];
        yield [
            new Polynomial([1]),
            new Polynomial([2, 5, 17, 3]),
            '2.x^3 + 5.x^2 + 17.x^1 + 3.x^0',
        ];
        yield [
            new Polynomial([1, 2]),
            new Polynomial([2, 5]),
            '2.x^2 + 9.x^1 + 10.x^0',
        ];
        yield [
            new Polynomial([1, 3, 5]),
            new Polynomial([2, 4, 6, 8]),
            '2.x^5 + 10.x^4 + 28.x^3 + 46.x^2 + 54.x^1 + 40.x^0',
        ];
    }


    /**
     * @dataProvider provideDataToTestDivide
     */
    public function testDivide(Polynomial $dividend, Polynomial|int|float $divisor, array|string $expected): void
    {
        $actual = $this->polynomialOperations->divide($dividend, $divisor);
        if (is_array($expected)) {
            $this->assertEquals($expected[0], "{$actual[0]}");
            $this->assertEquals($expected[1], "{$actual[1]}");
        } else {
            $this->assertEquals($expected, "$actual");
        }

    }

    public static function provideDataToTestDivide(): \Generator
    {
        yield [
            new Polynomial([2, 5, 15, 3]),
            3,
            '0.67.x^3 + 1.67.x^2 + 5.x^1 + 1.x^0'
        ];
        yield [
            new Polynomial([2, 5, 17, 3]),
            new Polynomial([1, 1]),
            ['2.x^2 + 3.x^1 + 14.x^0', '-11.x^0']
        ];
        yield [
            new Polynomial([3, 16, 20, 2, 11, 12]),
            new Polynomial([3, 1]),
            ['1.x^4 + 5.x^3 + 5.x^2 + -1.x^1 + 4.x^0', '8.x^0']
        ];
        yield [
            new Polynomial([3, 16, 20, 2, 11, 12]),
            new Polynomial([3, 4, 1, 2]),
            ['1.x^2 + 4.x^1 + 1.x^0', '-8.x^2 + 2.x^1 + 10.x^0']
        ];
    }
}