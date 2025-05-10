<?php

namespace Tests\Polynomial\Decorator;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\PowerOrder;
use ThePhpGuild\QrCode\Polynomial\Decorator\BinaryCodewordPolynomialDecorator;
use ThePhpGuild\QrCode\Polynomial\Polynomial;

class BinaryCodewordPolynomialDecoratorTest extends TestCase
{
    /**
     * @dataProvider provideDataToTestToString
     */
    public function testToString(Polynomial $polynomial, string $expectedString): void
    {
        $gf256Polynomial = new BinaryCodewordPolynomialDecorator($polynomial);
        $this->assertEquals($expectedString, "$gf256Polynomial");
    }

    public static function provideDataToTestToString(): \Generator
    {
        yield [new Polynomial(), ''];
        yield [new Polynomial([13, 233, 63]), '00001101.x^2 + 11101001.x^1 + 00111111.x^0'];
        yield [new Polynomial(
            [122, 21, 39],
            [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            '00100111.x^2 + 00010101.x^1 + 01111010.x^0'
        ];
    }
}