<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

class Masker5 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (
            $position->row() * $position->col() % 2 +
            $position->row() * $position->col() % 3 === 0
        );
    }
}
