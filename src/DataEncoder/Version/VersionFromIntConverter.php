<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version;

class VersionFromIntConverter
{
    public function __construct(readonly private int $version)
    {
    }

    public function fromInt(): Version
    {
        return match ($this->version) {
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