<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\MaskerFactoryInterface;
use Guillaumetissier\QrCode\Enums\Mask;

final class MaskerFactory implements MaskerFactoryInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function createMasker(Mask $mask): MaskerInterface
    {
        return match ($mask) {
            Mask::MASK0 => new Masker0(),
            Mask::MASK1 => new Masker1(),
            Mask::MASK2 => new Masker2(),
            Mask::MASK3 => new Masker3(),
            Mask::MASK4 => new Masker4(),
            Mask::MASK5 => new Masker5(),
            Mask::MASK6 => new Masker6(),
            Mask::MASK7 => new Masker7(),
        };
    }
}
