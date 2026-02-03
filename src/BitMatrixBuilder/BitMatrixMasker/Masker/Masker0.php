<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

class Masker0 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (($position->col() + $position->row()) % 2 === 0);
    }
}
