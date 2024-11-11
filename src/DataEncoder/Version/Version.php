<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

enum Version
{
    case V01;
    case V02;
    case V03;
    case V04;
    case V05;
    case V06;
    case V07;
    case V08;
    case V09;
    case V10;
    case V11;
    case V12;
    case V13;
    case V14;
    case V15;
    case V16;
    case V17;
    case V18;
    case V19;
    case V20;
    case V21;
    case V22;
    case V23;
    case V24;
    case V25;
    case V26;
    case V27;
    case V28;
    case V29;
    case V30;
    case V31;
    case V32;
    case V33;
    case V34;
    case V35;
    case V36;
    case V37;
    case V38;
    case V39;
    case V40;

    public function toInt(): int
    {
        return match ($this) {
            Version::V01 => 1,
            Version::V02 => 2,
            Version::V03 => 3,
            Version::V04 => 4,
            Version::V05 => 5,
            Version::V06 => 6,
            Version::V07 => 7,
            Version::V08 => 8,
            Version::V09 => 9,
            Version::V10 => 10,
            Version::V11 => 11,
            Version::V12 => 12,
            Version::V13 => 13,
            Version::V14 => 14,
            Version::V15 => 15,
            Version::V16 => 16,
            Version::V17 => 17,
            Version::V18 => 18,
            Version::V19 => 19,
            Version::V20 => 20,
            Version::V21 => 21,
            Version::V22 => 22,
            Version::V23 => 23,
            Version::V24 => 24,
            Version::V25 => 25,
            Version::V26 => 26,
            Version::V27 => 27,
            Version::V28 => 28,
            Version::V29 => 29,
            Version::V30 => 30,
            Version::V31 => 31,
            Version::V32 => 32,
            Version::V33 => 33,
            Version::V34 => 34,
            Version::V35 => 35,
            Version::V36 => 36,
            Version::V37 => 37,
            Version::V38 => 38,
            Version::V39 => 39,
            Version::V40 => 40
        };
    }

    public static function fromInt($int): Version
    {
        return match ($int) {
             1 => Version::V01,
             2 => Version::V02,
             3 => Version::V03,
             4 => Version::V04,
             5 => Version::V05,
             6 => Version::V06,
             7 => Version::V07,
             8 => Version::V08,
             9 => Version::V09,
            10 => Version::V10,
            11 => Version::V11,
            12 => Version::V12,
            13 => Version::V13,
            14 => Version::V14,
            15 => Version::V15,
            16 => Version::V16,
            17 => Version::V17,
            18 => Version::V18,
            19 => Version::V19,
            20 => Version::V20,
            21 => Version::V21,
            22 => Version::V22,
            23 => Version::V23,
            24 => Version::V24,
            25 => Version::V25,
            26 => Version::V26,
            27 => Version::V27,
            28 => Version::V28,
            29 => Version::V29,
            30 => Version::V30,
            31 => Version::V31,
            32 => Version::V32,
            33 => Version::V33,
            34 => Version::V34,
            35 => Version::V35,
            36 => Version::V36,
            37 => Version::V37,
            38 => Version::V38,
            39 => Version::V39,
            40 => Version::V40
        };
    }
}