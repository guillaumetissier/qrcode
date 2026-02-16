<?php

namespace Guillaumetissier\QrCode\Common\Helper;

use Guillaumetissier\BitString\BitStringInterface;

class BitStringFormatter
{
    public static function normalize(string $string): string
    {
        return str_replace([' ', '\n', PHP_EOL], '', $string);
    }

    public static function format(string|BitStringInterface $string, bool $hexadecimal = false): string
    {
        if ($string instanceof BitStringInterface) {
            $string = $string->toString();
        }

        $splitChunks = str_split($string, 80);
        foreach ($splitChunks as &$splitChunk) {
            if ($hexadecimal) {
                $splitChunk = join(' ', array_map(
                    fn(string $byte) => sprintf('0x%02X', bindec($byte)),
                    str_split($splitChunk, 8)
                ));
            } else {
                $splitChunk = join(' ', str_split($splitChunk, 8));
            }
        }

        return  join(PHP_EOL, $splitChunks);
    }
}
