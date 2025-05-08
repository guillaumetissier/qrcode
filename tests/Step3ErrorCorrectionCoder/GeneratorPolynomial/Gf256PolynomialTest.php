<?php

namespace Tests\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256Polynomial;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Polynomial;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\PowerOrder;

class Gf256PolynomialTest extends TestCase
{
    private Gf256 $gf256;

    public function setUp(): void
    {
        $this->gf256 = Gf256::getInstance();
    }

    /**
     * @dataProvider provideDataToTestToString
     */
    public function testToString(Polynomial $polynomial, string $expectedString): void
    {
        $gf256Polynomial = new Gf256Polynomial($this->gf256, $polynomial);
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