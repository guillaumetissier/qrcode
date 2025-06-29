<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

class BottomRightExtensionPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        foreach ($this->getPositions() as $position) {
            $matrix->setValueFromBottomRight($position, !$position->getRow() && !$position->getCol());
        }
    }
}
