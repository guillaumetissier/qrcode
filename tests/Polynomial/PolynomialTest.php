<?php

namespace Tests\Polynomial;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\PowerOrder;
use ThePhpGuild\QrCode\Polynomial\Polynomial;

class PolynomialTest extends TestCase
{
    /**
     * @dataProvider provideDataToTestToString
     */
    public function testToString(Polynomial $p, string $expectedString): void
    {
        $this->assertSame($expectedString, "$p");
    }

    public static function provideDataToTestToString(): \Generator
    {
        yield [new Polynomial(), ''];
        yield [new Polynomial([1]), '1.x^0'];
        yield [new Polynomial([1, 2, 3]), '1.x^2 + 2.x^1 + 3.x^0'];
        yield [new Polynomial([1, 0, 3]), '1.x^2 + 3.x^0'];
        yield [new Polynomial([1], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]), '1.x^0'];
        yield [
            new Polynomial([1, 2, 3], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            '3.x^2 + 2.x^1 + 1.x^0'
        ];
        yield [
            new Polynomial([1, 0, 3], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            '3.x^2 + 1.x^0'
        ];
    }

    /**
     * @dataProvider provideDataToTestGetDegree
     */
    public function testGetDegree(Polynomial $p, int $expectedDegree): void
    {
        $this->assertSame($expectedDegree, $p->getDegree());
    }

    public static function provideDataToTestGetDegree(): \Generator
    {
        yield [new Polynomial(), -1];
        yield [new Polynomial([1]), 0];
        yield [new Polynomial([1, 2, 3]), 2];
    }

    /**
     * @dataProvider provideDataToTestGetCoefficients
     */
    public function testGetCoefficients(Polynomial $p, array $expectedCoefficients): void
    {
        $this->assertSame($expectedCoefficients, $p->getCoefficients());
    }

    public static function provideDataToTestGetCoefficients(): \Generator
    {
        yield [new Polynomial(), []];
        yield [new Polynomial([1]), [1]];
        yield [new Polynomial([18, 24, 56, 34]), [34, 56, 24, 18]];
        yield [
            new Polynomial([16, 20, 67, 78], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            [16, 20, 67, 78]
        ];
    }

    /**
     * @dataProvider provideDataToTestGetCoefficient
     */
    public function testGetCoefficient(Polynomial $p, int $power, ?int $expectedCoefficient): void
    {
        $this->assertSame($expectedCoefficient, $p->getCoefficient($power));
    }

    public static function provideDataToTestGetCoefficient(): \Generator
    {
        yield [new Polynomial(), 0, null];
        yield [new Polynomial([1]), 0, 1];
        yield [new Polynomial([17, 21, 35, 49]), 2, 21];
        yield [new Polynomial([14, 22, 38, 42, 59, 61]), 2, 42];
        yield [new Polynomial([14, 22, 38, 42, 59, 61]), 10, null];
        yield [
            new Polynomial([17, 21, 35, 49], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            2,
            35
        ];
        yield [
            new Polynomial([14, 22, 38, 42, 59, 61], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            1,
            22
        ];
        yield [
            new Polynomial([14, 22, 38, 42, 59, 61], [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            8,
            null
        ];
    }

    /**
     * @dataProvider provideDataToTestSetCoefficient
     */
    public function testSetCoefficient(int $degree, int $power, int $coefficient, string $expected): void
    {
        $polynomial = new Polynomial($degree);
        $polynomial->setCoefficient($power, $coefficient);
        $this->assertEquals($expected, "$polynomial");
    }

    public static function provideDataToTestSetCoefficient(): \Generator
    {
        yield [3, 2, 2, '2.x^2'];
        yield [8, 8, 5, '5.x^8'];
        yield [1, 2, 2, '2.x^2'];
    }
}
