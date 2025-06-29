<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\RightExtensionPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

class RightExtensionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $matrix = new Matrix(45);
        $finderPatterns = new RightExtensionPatternsPlacer();
        $finderPatterns
            ->setPositions(
                new class implements PositionsInterface {
                    public function getPositions(): \Generator
                    {
                        yield new Position(0, 16);
                        yield new Position(0, 17);
                        yield new Position(0, 18);
                        yield new Position(0, 19);
                        yield new Position(1, 16);
                        yield new Position(1, 17);
                        yield new Position(1, 18);
                        yield new Position(1, 19);

                        yield new Position(0, 24);
                        yield new Position(0, 25);
                        yield new Position(0, 26);
                        yield new Position(0, 27);
                        yield new Position(1, 24);
                        yield new Position(1, 25);
                        yield new Position(1, 26);
                        yield new Position(1, 27);
                    }
                }
            )
            ->place($matrix->showValues());

        $this->assertEquals(
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx █' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL,
            "$matrix"
        );
    }
}
