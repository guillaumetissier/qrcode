<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\TimingPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\HorizontalTimingPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\SizeDependent;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\VerticalTimingPatternsPositions;

class TimingPatternsPlacerTest extends TestCase
{
    /**
     * @dataProvider provideDataToTestPlace
     */
    public function testPlace(PositionsInterface&SizeDependent $positions, string $expectedMatrix): void
    {
        $matrix = new Matrix(25);
        $positions->setSize(25);
        $finderPatterns = new TimingPatternsPlacer();
        $finderPatterns->setPositions($positions)->place($matrix);

        $this->assertEquals($expectedMatrix, "$matrix");
    }

    public static function provideDataToTestPlace(): \Generator
    {
        yield [
            new HorizontalTimingPatternsPositions(),
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '█ █ █ █ █ █ █ █ █ █ █ █ █' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '                         ' . PHP_EOL,
        ];

        yield [
            new VerticalTimingPatternsPositions(),
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL .
            '                         ' . PHP_EOL .
            '      █                  ' . PHP_EOL,
        ];
    }
}