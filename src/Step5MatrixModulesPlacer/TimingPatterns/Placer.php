<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\TimingPatterns;

use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;

class Placer extends AbstractPatternPlacer
{
    public function place(): QrMatrix
    {
        for ($i = 0; $i < $this->matrix->getSize(); $i++) {
            $this->matrix->set(6, $i, $i % 2 === 0);
            $this->matrix->set($i, 6, $i % 2 === 0);
        }

        return $this->matrix;
    }
}
