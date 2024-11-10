<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Encoder;

class AlphanumericEncoder extends AbstractEncoder
{
    public function encode(): string
    {
        $binaryData = '';
        $charMap = array_flip(str_split("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:"));
        $length = strlen($this->data);

        for ($i = 0; $i < $length; $i += 2) {
            $chunk = substr($this->data, $i, 2);
            if (strlen($chunk) == 2) {
                $value = $charMap[$chunk[0]] * 45 + $charMap[$chunk[1]];
                $binaryData .= str_pad(decbin($value), 11, '0', STR_PAD_LEFT);
            } else {
                $binaryData .= str_pad(decbin($charMap[$chunk[0]]), 6, '0', STR_PAD_LEFT);
            }
        }

        return $binaryData;
    }
}