<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixCreator;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrixCreator;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

class BitMatrixCreatorTest extends TestCase
{
    private BitMatrixCreator $bitMatrixCreator;

    public function setUp(): void
    {
        $this->bitMatrixCreator = BitMatrixCreator::create();
    }

    /**
     * @dataProvider dataCalculate
     */
    public function testCalculate(Version $version, int $expectedSize): void
    {
        $matrix = $this->bitMatrixCreator->withVersion($version)->createEmptyMatrix();
        $this->assertEquals($expectedSize, $matrix->size());
    }

    public static function dataCalculate(): \Generator
    {
        yield [Version::V01, 21];
        yield [Version::V02, 25];
        yield [Version::V03, 29];
        yield [Version::V04, 33];
        yield [Version::V05, 37];
        yield [Version::V06, 41];
        yield [Version::V07, 45];
        yield [Version::V08, 49];
        yield [Version::V09, 53];
        yield [Version::V10, 57];
        yield [Version::V11, 61];
        yield [Version::V12, 65];
        yield [Version::V13, 69];
        yield [Version::V14, 73];
        yield [Version::V15, 77];
        yield [Version::V16, 81];
        yield [Version::V17, 85];
        yield [Version::V18, 89];
        yield [Version::V19, 93];
        yield [Version::V20, 97];
        yield [Version::V21, 101];
        yield [Version::V22, 105];
        yield [Version::V23, 109];
        yield [Version::V24, 113];
        yield [Version::V25, 117];
        yield [Version::V26, 121];
        yield [Version::V27, 125];
        yield [Version::V28, 129];
        yield [Version::V29, 133];
        yield [Version::V30, 137];
        yield [Version::V31, 141];
        yield [Version::V32, 145];
        yield [Version::V33, 149];
        yield [Version::V34, 153];
        yield [Version::V35, 157];
        yield [Version::V36, 161];
        yield [Version::V37, 165];
        yield [Version::V38, 169];
        yield [Version::V39, 173];
        yield [Version::V40, 177];
    }
}
