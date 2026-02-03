<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerInterface;
use Guillaumetissier\QrCode\Enums\Mask;

interface MaskerFactoryInterface
{
    public function createMasker(Mask $mask): MaskerInterface;
}
