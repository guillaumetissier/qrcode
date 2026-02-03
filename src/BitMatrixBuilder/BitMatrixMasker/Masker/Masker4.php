<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

final class Masker4 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (((intdiv($position->row(), 2) + intdiv($position->col(), 3)) % 2) === 0);
    }
}
