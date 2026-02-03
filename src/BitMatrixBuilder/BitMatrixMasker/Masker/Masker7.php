<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

final class Masker7 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        // ((i j) mod 3 + (i+j) mod 2) mod 2 = 0
        return $value ^ (
            (
                ($position->row() * $position->col()) % 3 +
                ($position->row() + $position->col()) % 2
            )
            % 2 === 0
        );
    }
}
