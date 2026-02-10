<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PositionDetectionPatternsPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use PHPUnit\Framework\TestCase;

class PositionDetectionPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $matrix = BitMatrix::empty(25)->showValues();
        $functionPatternPositions = FunctionPatternPositions::empty();
        $patternsPlacer = new PositionDetectionPatternsPlacer($this->createPatternPositionsMock());
        $patternsPlacer->place($matrix, $functionPatternPositions);

        $this->assertEquals(
            '11111110xxxxxxxxx01111111' . PHP_EOL .
            '10000010xxxxxxxxx01000001' . PHP_EOL .
            '10111010xxxxxxxxx01011101' . PHP_EOL .
            '10111010xxxxxxxxx01011101' . PHP_EOL .
            '10111010xxxxxxxxx01011101' . PHP_EOL .
            '10000010xxxxxxxxx01000001' . PHP_EOL .
            '11111110xxxxxxxxx01111111' . PHP_EOL .
            '00000000xxxxxxxxx00000000' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            'xxxxxxxxxxxxxxxxxxxxxxxxx' . PHP_EOL .
            '00000000xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '11111110xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '10000010xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '10111010xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '10111010xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '10111010xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '10000010xxxxxxxxxxxxxxxxx' . PHP_EOL .
            '11111110xxxxxxxxxxxxxxxxx' . PHP_EOL,
            "$matrix"
        );

        // corner top left
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(0, 0)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(1, 1)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(2, 2)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(3, 3)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(4, 4)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(5, 5)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(6, 6)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(7, 7)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(8, 8)));
        // corner top right
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(24, 0)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(23, 1)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(22, 2)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(21, 3)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(20, 4)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(19, 5)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(18, 6)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(17, 7)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(16, 8)));
        // corner bottom left
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(0, 24)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(1, 23)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(2, 22)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(3, 21)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(4, 20)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(5, 19)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(6, 18)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(7, 17)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(8, 16)));
        // corner bottom right
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(17, 17)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(18, 18)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(19, 19)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(20, 20)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(21, 21)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(22, 22)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(23, 23)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(24, 24)));
    }

    private function createPatternPositionsMock(): PatternPositionsInterface
    {
        $mock = $this->createMock(PatternPositionsInterface::class);
        $mock->method('withVersion')->willReturnSelf();
        $mock->method('positions')->willReturn(
            (function () {
                yield Position::fromTopLeft(3, 3);
                yield Position::fromTopLeft(21, 3);
                yield Position::fromTopLeft(3, 21);
            })()
        );

        return $mock;
    }
}
