<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class TimingPatternsPlacer extends AbstractPositionDependentPatternsPlacer
{
    public function place(Matrix $matrix): void
    {
        $i = 0;
        /** @var Position $position */
        foreach ($this->getPositions() as $position) {
            $matrix->setValueFromTopLeft($position, $i % 2 === 0);
            $i++;
        }
    }
}
