<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

class Masker4 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (((intdiv($position->row(), 2) + intdiv($position->col(), 3)) % 2) === 0);
    }
}
