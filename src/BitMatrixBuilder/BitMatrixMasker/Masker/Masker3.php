<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

final class Masker3 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (($position->row() + $position->col()) % 3 === 0);
    }
}
