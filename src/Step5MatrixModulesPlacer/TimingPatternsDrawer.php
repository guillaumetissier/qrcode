<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

class TimingPatternsDrawer extends AbstractPatternDrawer
{
    public function draw(): QrMatrix
    {
        for ($i = 0; $i < $this->matrix->getSize(); $i++) {
            $this->matrix->set(6, $i, $i % 2 === 0);
            $this->matrix->set($i, 6, $i % 2 === 0);
        }

        return $this->matrix;
    }
}
