<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker\Masker;

use Exception;
use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use PHPUnit\Framework\TestCase;

abstract class MaskerTestCase extends TestCase
{
    protected MaskerInterface $masker;

    public function setUp(): void
    {
        $this->masker = $this->createMasker();
    }

    abstract protected function createMasker(): MaskerInterface;

    /**
     * @param BitMatrix $matrix
     * @param string $expected
     * @return void
     * @dataProvider dataMask
     */
    public function testMask(BitMatrix $matrix, string $expected): void
    {
        $positions = FunctionPatternPositions::empty();
        $actual = $this->masker->withFunctionPatternPositions($positions)->mask($matrix);
        $this->assertSame($expected, "$actual");
    }

    /**
     * @return Generator
     * @throws Exception
     */
    public static function dataMask(): Generator
    {
        throw new Exception('Should not be reached');
    }

    /**
     * @param BitMatrix $matrix
     * @param list<Position> $positions
     * @param string $expected
     * @return void
     *
     * @dataProvider dataMaskWithFunctionPatternPositions
     *
     */
    public function testMaskWithFunctionPatternPositions(BitMatrix $matrix, array $positions, string $expected): void
    {
        $actual = $this->masker
            ->withFunctionPatternPositions(FunctionPatternPositions::fromArray($positions))
            ->mask($matrix);
        $this->assertSame($expected, "$actual");
    }

    /**
     * @return Generator
     * @throws Exception
     */
    public static function dataMaskWithFunctionPatternPositions(): Generator
    {
        throw new Exception('Should not be reached');
    }
}
