<?php

namespace Tests\Polynomial\Operations;

use Tests\Fixture\IoLoggerTrait;
use ThePhpGuild\QrCode\Polynomial\Operations\PolynomialOperations;
use ThePhpGuild\QrCode\Polynomial\Polynomial;
use ThePhpGuild\QrCode\Scalar\Operations\Gf256Operations;

class Gf256PolynomialOperationsTest extends BasePolynomialOperationsTestCase
{
    use IoLoggerTrait;

    public function setUp(): void
    {
        $this->polynomialOperations = new PolynomialOperations(Gf256Operations::getInstance());
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
            '9.x^4 + 10.x^3 + 19.x^2 + 16.x^1 + 21.x^0',
        ];
        yield [
            new Polynomial([1, 2, 3, 4, 5]),
            new Polynomial([13, 12, 11]),
            '1.x^4 + 2.x^3 + 14.x^2 + 8.x^1 + 14.x^0',
        ];
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
            '9.x^4 + 10.x^3 + 23.x^2 + 6.x^1 + 21.x^0',
        ];
        yield [
            new Polynomial([1, 23, 3, 12, 5]),
            new Polynomial([13, 7, 11]),
            '1.x^4 + 23.x^3 + 14.x^2 + 11.x^1 + 14.x^0',
        ];
        yield [
            new Polynomial([16, 32, 12, 86, 97, 128, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17]),
            new Polynomial([16, 32, 12, 86, 97, 128, 153, 152, 202, 156, 154, 61, 233, 138, 212, 204]),
            '117.x^9 + 137.x^8 + 38.x^7 + 141.x^6 + 118.x^5 + 44.x^4 + 5.x^3 + 155.x^2 + 56.x^1 + 221.x^0'
        ];
    }

    public static function provideDataToTestMultiply(): \Generator
    {
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
            '2.x^2 + 1.x^1 + 10.x^0',
        ];
        yield [
            new Polynomial([   1, 3, 5]),
            new Polynomial([2, 4, 6, 8]),
            '2.x^5 + 2.x^4 + 22.x^2 + 6.x^1 + 40.x^0',
        ];
        yield [
            new Polynomial([1, 216, 194, 159, 111, 199, 94, 95, 113, 157, 193]),
            new Polynomial([16, 33, 106, 209, 247, 211]),
            '16.x^15 + 32.x^14 + 12.x^13 + 86.x^12 + '.
            '97.x^11 + 128.x^10 + 153.x^9 + 152.x^8 + '.
            '202.x^7 + 156.x^6 + 154.x^5 + 61.x^4 + '.
            '233.x^3 + 138.x^2 + 212.x^1 + 204.x^0'
        ];
    }

    public static function provideDataToTestDivide(): \Generator
    {
        // see example annex G. not working
        yield [
            new Polynomial([16, 32, 12, 86, 97, 128, 236, 17, 236, 17, 236, 17, 236, 17, 236, 17]),
            new Polynomial([1, 216, 194, 159, 111, 199, 94, 95, 113, 157, 193]),
            [
                '16.x^5 + 33.x^4 + 106.x^3 + 209.x^2 + 247.x^1 + 211.x^0',
                '117.x^9 + 137.x^8 + 38.x^7 + 141.x^6 + 118.x^5 + 44.x^4 + 5.x^3 + 155.x^2 + 56.x^1 + 221.x^0'
            ]
        ];
        yield [
            new Polynomial([16, 32, 12, 86]),
            new Polynomial([1, 216]),
            [
                '16.x^2 + 33.x^1 + 214.x^0',
                '177.x^0'
            ]
        ];
        yield [
            new Polynomial([16, 32, 12, 86]),
            new Polynomial([1, 1, 4]),
            [
                '16.x^1 + 48.x^0',
                '124.x^1 + 150.x^0',
            ]
        ];
    }
}