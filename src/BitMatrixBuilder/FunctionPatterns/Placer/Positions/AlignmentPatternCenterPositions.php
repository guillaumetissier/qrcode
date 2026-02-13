<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class AlignmentPatternCenterPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        $coordinates = $this->getRowColumnCoordinates();
        $lastCoordinate = count($coordinates) - 1;

        for ($x = 0; $x < count($coordinates); $x++) {
            for ($y = 0; $y < count($coordinates); $y++) {
                if (0 === $x && in_array($y, [0, $lastCoordinate])) {
                    continue;
                }

                if (0 === $y && $lastCoordinate === $x) {
                    continue;
                }

                yield Position::fromTopLeft($coordinates[$x], $coordinates[$y]);
            }
        }
    }

    /**
     * @return int[]
     * @throws MissingInfoException
     */
    private function getRowColumnCoordinates(): array
    {
        return match ($this->version()) {
            Version::V01 => [],
            Version::V02 => [6, 18],
            Version::V03 => [6, 22],
            Version::V04 => [6, 26],
            Version::V05 => [6, 30],
            Version::V06 => [6, 34],
            Version::V07 => [6, 22, 38],
            Version::V08 => [6, 24, 42],
            Version::V09 => [6, 26, 46],
            Version::V10 => [6, 28, 50],
            Version::V11 => [6, 30, 54],
            Version::V12 => [6, 32, 58],
            Version::V13 => [6, 34, 62],
            Version::V14 => [6, 26, 46, 66],
            Version::V15 => [6, 26, 48, 70],
            Version::V16 => [6, 26, 50, 74],
            Version::V17 => [6, 30, 54, 78],
            Version::V18 => [6, 30, 56, 82],
            Version::V19 => [6, 30, 58, 86],
            Version::V20 => [6, 34, 62, 90],
            Version::V21 => [6, 28, 50, 72, 94],
            Version::V22 => [6, 26, 50, 74, 98],
            Version::V23 => [6, 30, 54, 78, 102],
            Version::V24 => [6, 28, 54, 80, 106],
            Version::V25 => [6, 32, 58, 84, 110],
            Version::V26 => [6, 30, 58, 86, 114],
            Version::V27 => [6, 34, 62, 90, 118],
            Version::V28 => [6, 30, 50, 74, 98, 122],
            Version::V29 => [6, 34, 54, 78, 102, 126],
            Version::V30 => [6, 26, 52, 78, 104, 130],
            Version::V31 => [6, 34, 56, 82, 108, 134],
            Version::V32 => [6, 30, 60, 86, 112, 138],
            Version::V33 => [6, 34, 58, 86, 114, 142],
            Version::V34 => [6, 30, 62, 90, 118, 146],
            Version::V35 => [6, 30, 54, 78, 102, 126, 150],
            Version::V36 => [6, 24, 50, 76, 102, 128, 154],
            Version::V37 => [6, 28, 54, 80, 106, 132, 158],
            Version::V38 => [6, 32, 58, 84, 110, 136, 162],
            Version::V39 => [6, 26, 54, 82, 110, 138, 166],
            Version::V40 => [6, 30, 58, 86, 114, 142, 170],
        };
    }
}
