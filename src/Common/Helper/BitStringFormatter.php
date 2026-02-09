<?php

namespace Guillaumetissier\QrCode\Common\Helper;

use Guillaumetissier\BitString\BitStringInterface;

class BitStringFormatter
{
    public static function normalize(string $string): string
    {
        return str_replace([' ', '\n'], '', $string);
    }

    public static function format(string|BitStringInterface $string): string
    {
        if ($string instanceof BitStringInterface) {
            $string = $string->toString();
        }

        return join(' ', str_split($string, 8));
    }
}
