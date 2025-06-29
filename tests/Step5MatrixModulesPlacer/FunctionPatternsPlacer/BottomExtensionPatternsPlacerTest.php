<?php

namespace Tests\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer\BottomExtensionPatternsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

class BottomExtensionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $matrix = new Matrix(45);
        $finderPatterns = new BottomExtensionPatternsPlacer();
        $finderPatterns
            ->setPositions(
                new class implements PositionsInterface {
                    public function getPositions(): \Generator
                    {
                        yield new Position(16, 0);
                        yield new Position(17, 0);
                        yield new Position(18, 0);
                        yield new Position(19, 0);
                        yield new Position(16, 1);
                        yield new Position(17, 1);
                        yield new Position(18, 1);
                        yield new Position(19, 1);

                        yield new Position(24, 0);
                        yield new Position(25, 0);
                        yield new Position(26, 0);
                        yield new Position(27, 0);
                        yield new Position(24, 1);
                        yield new Position(25, 1);
                        yield new Position(26, 1);
                        yield new Position(27, 1);
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
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxx    xxxx    xxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxx████xxxx████xxxxxxxxxxxxxxxx' . PHP_EOL,
            "$matrix"
        );
    }
}
