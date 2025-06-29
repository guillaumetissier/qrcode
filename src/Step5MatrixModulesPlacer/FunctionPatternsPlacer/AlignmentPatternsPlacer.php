<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class AlignmentPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        /** @var Position $position */
        foreach ($this->getPositions() as $position) {
            for ($row = -2; $row <= 2; $row++) {
                for ($col = -2; $col <= 2; $col++) {
                    $matrix->setValueFromTopLeft(
                        new Position($position->getCol() + $col, $position->getRow() + $row),
                        (abs($row) == 2 || abs($col) == 2 || ($row == 0 && $col == 0))
                    );
                }
            }
        }
    }
}
