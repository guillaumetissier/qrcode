<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;

class RightExtensionPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        foreach ($this->getPositions() as $position) {
            $matrix->setValueFromBottomRight($position, !$position->getCol());
        }
    }
}
