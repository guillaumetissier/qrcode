<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\HorizontalTimingPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\VerticalTimingPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\TimingPatternsPlacer;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class TimingPatternsPlacerTest extends TestCase
{
    /**
     * @param PatternPositionsInterface $positions
     * @param string $expectedMatrix
     * @return void
     * @throws MissingInfoException
     *
     * @dataProvider provideDataToTestPlace
     */
    public function testPlace(PatternPositionsInterface $positions, string $expectedMatrix): void
    {
        $version = Version::V02;
        $matrix = BitMatrix::empty($version->size());
        $functionPatternPositions = NonDataPositions::empty();
        $patternsPlacer = new TimingPatternsPlacer($positions);
        $patternsPlacer
            ->withVersion($version)
            ->place($matrix, $functionPatternPositions);

        $this->assertEquals($expectedMatrix, "$matrix");
    }

    public static function provideDataToTestPlace(): \Generator
    {
        yield [
            new HorizontalTimingPatternPositions(),
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
            new VerticalTimingPatternPositions(),
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
