<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\Common\Position;

final class Masker0 extends AbstractMasker
{
    protected function maskPixel(int $value, Position $position): int
    {
        return $value ^ (($position->col() + $position->row()) % 2 === 0);
    }
}
