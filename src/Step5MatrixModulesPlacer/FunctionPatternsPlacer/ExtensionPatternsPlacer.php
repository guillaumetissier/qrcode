<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class ExtensionPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        foreach ($this->getPositions() as $position) {
            if ($position->equals(0, 0)) {
                foreach ([0, 1] as $row) {
                    foreach ([0, 1] as $col) {
                        $matrix->setValueFromBottomRight(new Position($col, $row), !$row && !$col);
                    }
                }
            } else if ($position->getCol() === 0) {
                $rowStart = $position->getRow();
                foreach (range($rowStart, $rowStart + 7) as $row) {
                    foreach ([0, 1] as $col) {
                        $matrix->setValueFromBottomRight(new Position($col, $row), !$col);
                    }
                }
            } else {
                $colStart = $position->getCol();
                foreach ([0, 1] as $row) {
                    foreach (range($colStart, $colStart + 7) as $col) {
                        $matrix->setValueFromBottomRight(new Position($col, $row), !$row);
                    }
                }
            }
        }
    }
}
