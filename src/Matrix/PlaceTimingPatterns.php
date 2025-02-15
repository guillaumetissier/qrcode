<?php

namespace ThePhpGuild\QrCode\Matrix;

class PlaceTimingPatterns extends AbstractPlacePatterns
{
    public function execute(): QrMatrix
    {
        for ($i = 8; $i < $this->matrix->getSize() - 8; $i++) {
            $this->matrix->set(6, $i, $i % 2 == 0);
            $this->matrix->set($i, 6, $i % 2 == 0);
        }

        return $this->matrix;
    }
}
