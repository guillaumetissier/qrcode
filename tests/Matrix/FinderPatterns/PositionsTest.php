<?php

namespace Tests\Matrix\FinderPatterns;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Matrix\FinderPatterns\Positions;
use ThePhpGuild\QrCode\Matrix\MatrixSizeCalculator;

class PositionsTest extends TestCase
{
    private Positions $positions;

    protected function setUp(): void
    {
        parent::setUp();

        $matrixSizeCalculator = $this->createMock(MatrixSizeCalculator::class);
        $matrixSizeCalculator->method('setVersion')->willReturnSelf();
        $matrixSizeCalculator->method('calculate')->willReturn(45);
        $this->positions = new Positions($matrixSizeCalculator);
    }

    public function testGetPositions(): void
    {
        $this->assertEquals([[4, 4], [41, 4], [4, 41]], $this->positions->getPositions());
    }
}
