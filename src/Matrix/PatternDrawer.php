<?php

namespace ThePhpGuild\QrCode\Matrix;

class PatternDrawer extends AbstractPatternDrawer
{
    public function draw(): QrMatrix
    {
        for ($i = 8; $i < $this->matrix->getSize() - 8; $i++) {
            $this->matrix->set(6, $i, $i % 2 == 0);
            $this->matrix->set($i, 6, $i % 2 == 0);
        }

        return $this->matrix;
    }
}
