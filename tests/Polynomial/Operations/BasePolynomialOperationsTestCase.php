<?php

namespace Tests\Polynomial\Operations;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Polynomial\Operations\PolynomialOperationsInterface;
use ThePhpGuild\QrCode\Polynomial\Polynomial;

class BasePolynomialOperationsTestCase extends TestCase
{
    protected PolynomialOperationsInterface $polynomialOperations;

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
        throw new \Exception('Not implemented');
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
        throw new \Exception('Not implemented');
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
        throw new \Exception('Not implemented');
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
        throw new \Exception('Not implemented');
    }
}