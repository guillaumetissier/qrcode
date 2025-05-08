<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AlignmentPatterns;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\PositionsInterface;

class Positions implements PositionsInterface
{
    private ?Version $version = null;

    public function setVersion(Version $version):self
    {
        $this->version = $version;

        return $this;
    }

    public function getPositions(): array
    {
        $positions = [];
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

                $positions[] = [$coordinates[$x], $coordinates[$y]];
            }
        }

        return $positions;
    }

    public function getRowColumnCoordinates(): array
    {
        return [
            Version::V01->value => [],
            Version::V02->value => [6, 18],
            Version::V03->value => [6, 22],
            Version::V04->value => [6, 26],
            Version::V05->value => [6, 30],
            Version::V06->value => [6, 34],
            Version::V07->value => [6, 22, 38],
            Version::V08->value => [6, 24, 42],
            Version::V09->value => [6, 26, 46],
            Version::V10->value => [6, 28, 50],
            Version::V11->value => [6, 30, 54],
            Version::V12->value => [6, 32, 58],
            Version::V13->value => [6, 34, 62],
            Version::V14->value => [6, 26, 46, 66],
            Version::V15->value => [6, 26, 48, 70],
            Version::V16->value => [6, 26, 50, 74],
            Version::V17->value => [6, 30, 54, 78],
            Version::V18->value => [6, 30, 56, 82],
            Version::V19->value => [6, 30, 58, 86],
            Version::V20->value => [6, 34, 62, 90],
            Version::V21->value => [6, 28, 50, 72, 94],
            Version::V22->value => [6, 26, 50, 74, 98],
            Version::V23->value => [6, 30, 54, 78, 102],
            Version::V24->value => [6, 28, 54, 80, 106],
            Version::V25->value => [6, 32, 58, 84, 110],
            Version::V26->value => [6, 30, 58, 86, 114],
            Version::V27->value => [6, 34, 62, 90, 118],
            Version::V28->value => [6, 30, 50, 74, 98, 122],
            Version::V29->value => [6, 34, 54, 78, 102, 126],
            Version::V30->value => [6, 26, 52, 78, 104, 130],
            Version::V31->value => [6, 34, 56, 82, 108, 134],
            Version::V32->value => [6, 30, 60, 86, 112, 138],
            Version::V33->value => [6, 34, 58, 86, 114, 142],
            Version::V34->value => [6, 30, 62, 90, 118, 146],
            Version::V35->value => [6, 30, 54, 78, 102, 126, 150],
            Version::V36->value => [6, 24, 50, 76, 102, 128, 154],
            Version::V37->value => [6, 28, 54, 80, 106, 132, 158],
            Version::V38->value => [6, 32, 58, 84, 110, 136, 162],
            Version::V39->value => [6, 26, 54, 82, 110, 138, 166],
            Version::V40->value => [6, 30, 58, 86, 114, 142, 170],
        ][$this->version->value] ?? [];
    }
}
