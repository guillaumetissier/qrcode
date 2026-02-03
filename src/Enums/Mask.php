<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum Mask: int
{
    case MASK0 = 0;
    case MASK1 = 1;
    case MASK2 = 2;
    case MASK3 = 3;
    case MASK4 = 4;
    case MASK5 = 5;
    case MASK6 = 6;
    case MASK7 = 7;

    /**
     * @return Mask[]
     */
    public static function all(): array
    {
        return [
            self::MASK0,
            self::MASK1,
            self::MASK2,
            self::MASK3,
            self::MASK4,
            self::MASK5,
            self::MASK6,
            self::MASK7,
        ];
    }

    /**
     * @param int $value
     * @return self
     */
    public static function fromInt(int $value): self
    {
        return self::all()[$value];
    }
}
