<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

final class Masker2 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ ($position->col() % 3 === 0);
    }
}
