<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

class Masker2 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ ($position->col() % 3 === 0);
    }
}
