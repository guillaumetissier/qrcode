<?php

namespace Tests\Step5MatrixModulesPlacer\Positions;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\FinderPatternsCenterPositions as Positions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class FinderPatternsTest extends TestCase
{
    private Positions $positions;

    protected function setUp(): void
    {
        $this->positions = new Positions();
    }

    /**
     * @dataProvider provideDataToTestGetPositions
     */
    public function testGetPositions(int $size, array $expectedPositions): void
    {
        $p = 0;
        foreach ($this->positions->setSize(45)->getPositions() as $position) {
            $this->assertEquals($expectedPositions[$p++], $position);
        }
    }

    public static function provideDataToTestGetPositions(): \Generator
    {
        yield [45, [new Position(3, 3), new Position(41, 3), new Position(3, 41)]];
    }
}
