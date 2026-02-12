<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer;

use Generator;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\BottomLeftVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\DarkModulePositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\HorizontalFormatInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionsInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\TopRightVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\VerticalFormatInfoPositions;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class InfoModulePlacerTest extends TestCase
{
    /**
     * @param InfoModulePositionsInterface $infoModulePositions
     * @param Version $version
     * @param string $data
     * @param string $expected
     * @return void
     * @throws MissingInfoException
     * @dataProvider dataPlace
     */
    public function testPlace(
        InfoModulePositionsInterface $infoModulePositions,
        Version $version,
        string $data,
        string $expected
    ): void {
        $infoModulePlacer = new InfoModulePlacer($infoModulePositions->withVersion($version));
        $matrix = BitMatrix::empty($version->size())->showValues();
        $infoModulePlacer
            ->withData($this->createBitString($data))
            ->place($matrix);

        $this->assertSame($expected, "$matrix");
    }

    /**
     * @return Generator<array{
     *     InfoModulePositionsInterface,
     *     Version,
     *     string,
     *     string
     * }>
     */
    public static function dataPlace(): Generator
    {
        yield [
            new BottomLeftVersionInfoPositions(),
            Version::V04,
            '123456789012345678',
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '147036...........................' . PHP_EOL .
            '258147...........................' . PHP_EOL .
            '369258...........................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL .
            '.................................' . PHP_EOL,
        ];

        yield [
            new TopRightVersionInfoPositions(),
            Version::V02,
            '123456789012345678',
            '..............123........' . PHP_EOL .
            '..............456........' . PHP_EOL .
            '..............789........' . PHP_EOL .
            '..............012........' . PHP_EOL .
            '..............345........' . PHP_EOL .
            '..............678........' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL .
            '.........................' . PHP_EOL,
        ];

        yield [
            new DarkModulePositions(),
            Version::V03,
            '1',
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '........1....................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL .
            '.............................' . PHP_EOL,
        ];

        yield [
            new HorizontalFormatInfoPositions(),
            Version::V01,
            '012345678901234',
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '432109.8.....76543210' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL .
            '.....................' . PHP_EOL,
        ];

        yield [
            new VerticalFormatInfoPositions(),
            Version::V05,
            '012345678901234',
            '........0............................' . PHP_EOL .
            '........1............................' . PHP_EOL .
            '........2............................' . PHP_EOL .
            '........3............................' . PHP_EOL .
            '........4............................' . PHP_EOL .
            '........5............................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '........6............................' . PHP_EOL .
            '........7............................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '.....................................' . PHP_EOL .
            '........8............................' . PHP_EOL .
            '........9............................' . PHP_EOL .
            '........0............................' . PHP_EOL .
            '........1............................' . PHP_EOL .
            '........2............................' . PHP_EOL .
            '........3............................' . PHP_EOL .
            '........4............................' . PHP_EOL,
        ];
    }

    private function createBitString(string $data): BitStringInterface
    {
        $mock = $this->createMock(BitStringInterface::class);
        $mock->method('toString')->willReturn($data);

        return $mock;
    }
}
