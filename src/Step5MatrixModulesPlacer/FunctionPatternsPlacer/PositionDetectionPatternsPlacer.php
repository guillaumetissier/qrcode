<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class PositionDetectionPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        /** @var Position $position */
        foreach ($this->getPositions() as $position) {
            for ($row = -3; $row <= 3; $row++) {
                for ($col = -3; $col <= 3; $col++) {
                    $matrix->setValueFromTopLeft(
                        new Position($position->getCol() + $col, $position->getRow() + $row),
                        abs($row) == 3 || abs($col) == 3 || (abs($row) <= 1 && abs($col) <= 1)
                    );
                }
            }
        }
    }
}
