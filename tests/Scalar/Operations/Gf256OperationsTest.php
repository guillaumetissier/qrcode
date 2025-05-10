<?php

namespace Tests\Scalar\Operations;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Scalar\Operations\Gf256Operations;

class Gf256OperationsTest extends TestCase
{
    private Gf256Operations $gf256Operations;

    protected function setUp(): void
    {
        $this->gf256Operations = Gf256Operations::getInstance();
    }

    /**
     * @dataProvider provideDataToAdd
     */
    public function testAdd(int $a, int $b, int $expectedSum): void
    {
        $this->assertEquals($expectedSum, $this->gf256Operations->add($a, $b));
    }

    public static function provideDataToAdd(): array
    {
        return [
            [123, 45, 86],
            [201, 89, 144],
            [1, 238, 239],
            [5, 134, 131],
            [176, 23, 167],
            [96, 70, 38],
            [114, 187, 201],
            [66, 55, 117],
        ];
    }

    /**
     * @dataProvider provideDataToMultiply
     */
    public function testMultiply(int $a, int $b, int $expectedResult): void
    {
        $this->assertEquals($expectedResult, $this->gf256Operations->multiply($a, $b));
    }

    public static function provideDataToMultiply(): array
    {
        return [
            [123, 45, 174],
            [201, 89, 243],
            [1, 238, 238],
            [5, 134, 164],
            [176, 23, 248],
            [96, 70, 120],
            [114, 187, 11],
            [66, 55, 47],
            [16, 216, 1],
            [33, 216, 218],
            [214, 216, 231]
        ];
    }
}
