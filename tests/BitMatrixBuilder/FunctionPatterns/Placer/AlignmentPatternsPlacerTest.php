<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\AlignmentPatternsPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

class AlignmentPatternsPlacerTest extends TestCase
{
    public function testPlace(): void
    {
        $version = Version::V02;
        $matrix = BitMatrix::empty($version->size());
        $finderPatterns = new AlignmentPatternsPlacer($this->createPatternPositionsMock());
        $functionPatternPositions = FunctionPatternPositions::empty();
        $finderPatterns->withVersion($version)->place($matrix, $functionPatternPositions);

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

        // corner top left
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(0, 0)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(1, 1)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(2, 2)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(3, 3)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(4, 4)));
        $this->assertTrue($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(5, 5)));
        $this->assertFalse($functionPatternPositions->isAFunctionPatternPosition(Position::fromTopLeft(6, 6)));

        // corner bottom right
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
