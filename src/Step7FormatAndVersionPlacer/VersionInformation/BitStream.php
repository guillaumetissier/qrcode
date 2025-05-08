<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer\VersionInformation;

use ThePhpGuild\QrCode\Enums\Version;

class BitStream
{
    public static function toBitStream(Version $version): ?string
    {
        return match ($version) {
            Version::V07 => "000111110010010100",
            Version::V08 => "001000010110111100",
            Version::V09 => "001001101010011001",
            Version::V10 => "001010010011010011",
            Version::V11 => "001011101111110110",
            Version::V12 => "001100011101100010",
            Version::V13 => "001101100001000111",
            Version::V14 => "001110011000001101",
            Version::V15 => "001111100100101000",
            Version::V16 => "010000101101111000",
            Version::V17 => "010001010001011101",
            Version::V18 => "010010101000010111",
            Version::V19 => "010011010100110010",
            Version::V20 => "010100100110100110",
            Version::V21 => "010101011010000011",
            Version::V22 => "010110100011001001",
            Version::V23 => "010111011111101100",
            Version::V24 => "011000111011000100",
            Version::V25 => "011001000111100001",
            Version::V26 => "011010111110101011",
            Version::V27 => "011011000010001110",
            Version::V28 => "011100110000011010",
            Version::V29 => "011101001100111111",
            Version::V30 => "011110110101110101",
            Version::V31 => "011111001001010000",
            Version::V32 => "100000100111010101",
            Version::V33 => "100001011011110000",
            Version::V34 => "100010100010111010",
            Version::V35 => "100011011110011111",
            Version::V36 => "100100101100001011",
            Version::V37 => "100101010000101110",
            Version::V38 => "100110101001100100",
            Version::V39 => "100111010101000001",
            Version::V40 => "101000110001101001",
            default => null
        };
    }
}
