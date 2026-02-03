<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum Version: int
{
    case V01 = 1;
    case V02 = 2;
    case V03 = 3;
    case V04 = 4;
    case V05 = 5;
    case V06 = 6;
    case V07 = 7;
    case V08 = 8;
    case V09 = 9;
    case V10 = 10;
    case V11 = 11;
    case V12 = 12;
    case V13 = 13;
    case V14 = 14;
    case V15 = 15;
    case V16 = 16;
    case V17 = 17;
    case V18 = 18;
    case V19 = 19;
    case V20 = 20;
    case V21 = 21;
    case V22 = 22;
    case V23 = 23;
    case V24 = 24;
    case V25 = 25;
    case V26 = 26;
    case V27 = 27;
    case V28 = 28;
    case V29 = 29;
    case V30 = 30;
    case V31 = 31;
    case V32 = 32;
    case V33 = 33;
    case V34 = 34;
    case V35 = 35;
    case V36 = 36;
    case V37 = 37;
    case V38 = 38;
    case V39 = 39;
    case V40 = 40;

    public function size(): int
    {
        return 21 + 4 * ($this->value - 1);
    }

    /**
     * @return Version[]
     */
    public static function all(): array
    {
        return [
            Version::V01,
            Version::V02,
            Version::V03,
            Version::V04,
            Version::V05,
            Version::V06,
            Version::V07,
            Version::V08,
            Version::V09,
            Version::V10,
            Version::V11,
            Version::V12,
            Version::V13,
            Version::V14,
            Version::V15,
            Version::V16,
            Version::V17,
            Version::V18,
            Version::V19,
            Version::V20,
            Version::V21,
            Version::V22,
            Version::V23,
            Version::V24,
            Version::V25,
            Version::V26,
            Version::V27,
            Version::V28,
            Version::V29,
            Version::V30,
            Version::V31,
            Version::V32,
            Version::V33,
            Version::V34,
            Version::V35,
            Version::V36,
            Version::V37,
            Version::V38,
            Version::V39,
            Version::V40,
        ];
    }
}
