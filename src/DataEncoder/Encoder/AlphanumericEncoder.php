<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

class AlphanumericEncoder extends AbstractEncoder
{
    public function encode(): string
    {
        $binaryData = '';
        $charMap = array_flip(str_split("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ $%*+-./:"));
        $length = strlen($this->data);

        $this->logger->debug("Input << {$this->data} (length: {$length})");

        for ($i = 0; $i < $length; $i += 2) {
            $chunk = substr($this->data, $i, 2);
            if (strlen($chunk) == 2) {
                $value = $charMap[$chunk[0]] * 45 + $charMap[$chunk[1]];
                $binaryData .= str_pad(decbin($value), 11, '0', STR_PAD_LEFT);
            } else {
                $binaryData .= str_pad(decbin($charMap[$chunk[0]]), 6, '0', STR_PAD_LEFT);
            }
        }

        $this->logger->debug("Output >> {$binaryData}");

        return $binaryData;
    }
}