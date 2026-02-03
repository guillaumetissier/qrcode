<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

class Masker6 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        // ((i j) mod 2 + (i j) mod 3) mod 2 = 0
        return $value ^ (
            (
                ($position->row() * $position->col()) % 2 +
                ($position->row() * $position->col()) % 3
            ) % 2 === 0
        );
    }
}
