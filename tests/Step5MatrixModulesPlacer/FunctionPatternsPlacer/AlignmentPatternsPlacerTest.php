<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\AlignmentPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

class AlignmentPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $matrix = new Matrix(25);
        $finderPatterns = new AlignmentPatternsPlacer();
        $finderPatterns
            ->setPositions(
                new class implements PositionsInterface {
                    public function getPositions(): \Generator
                    {
                        yield new Position(3, 3);
                        yield new Position(21, 3);
                        yield new Position(3, 21);
                    }
                }
            )
            ->place($matrix);

        $this->assertEquals(
            '                         ' . PHP_EOL .
            ' █████             █████ ' . PHP_EOL .
            ' █   █             █   █ ' . PHP_EOL .
            ' █ █ █             █ █ █ ' . PHP_EOL .
            ' █   █             █   █ ' . PHP_EOL .
            ' █████             █████ ' . PHP_EOL .
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
            ' █████                   ' . PHP_EOL .
            ' █   █                   ' . PHP_EOL .
            ' █ █ █                   ' . PHP_EOL .
            ' █   █                   ' . PHP_EOL .
            ' █████                   ' . PHP_EOL .
            '                         ' . PHP_EOL,
            "$matrix"
        );
    }
}
