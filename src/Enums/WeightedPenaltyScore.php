<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum WeightedPenaltyScore
{
    case N1;
    case N2;
    case N3;
    case N4;

    public function toInt(): int
    {
        return match ($this) {
            self::N1, self::N2 => 3,
            self::N3 => 40,
            self::N4 => 10,
        };
    }
}
