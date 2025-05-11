<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\TimingPatterns;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;

class Placer extends AbstractPatternPlacer
{
    public function place(): Matrix
    {
        for ($i = 0; $i < $this->matrix->getSize(); $i++) {
            $this->matrix->set(6, $i, $i % 2 === 0);
            $this->matrix->set($i, 6, $i % 2 === 0);
        }

        return $this->matrix;
    }
}
