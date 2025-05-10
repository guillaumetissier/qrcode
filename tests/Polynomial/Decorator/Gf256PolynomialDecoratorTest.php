<?php

namespace Tests\Polynomial\Decorator;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Enums\PowerOrder;
use ThePhpGuild\QrCode\Polynomial\Decorator\Gf256PolynomialDecorator;
use ThePhpGuild\QrCode\Polynomial\Polynomial;
use ThePhpGuild\QrCode\Scalar\Gf256;

class Gf256PolynomialDecoratorTest extends TestCase
{
    /**
     * @dataProvider provideDataToTestToString
     */
    public function testToString(Polynomial $polynomial, string $expectedString): void
    {
        $gf256Polynomial = new Gf256PolynomialDecorator(Gf256::getInstance(), $polynomial);
        $this->assertEquals($expectedString, "$gf256Polynomial");
    }

    public static function provideDataToTestToString(): \Generator
    {
        yield [new Polynomial(), ''];
        yield [new Polynomial([1, 2, 3]), 'a^0.x^2 + a^1.x^1 + a^25.x^0'];
        yield [new Polynomial(
            [1, 2, 3],
            [Polynomial::POWER_ORDER => PowerOrder::LOWEST_POWER_FIRST]),
            'a^25.x^2 + a^1.x^1 + a^0.x^0'
        ];
    }
}