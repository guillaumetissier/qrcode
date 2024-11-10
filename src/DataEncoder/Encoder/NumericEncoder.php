<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Encoder;

class NumericEncoder extends AbstractEncoder
{
    public function encode(): string
    {
        $binaryData = '';
        $length = strlen($this->data);

        for ($i = 0; $i < $length; $i += 3) {
            $chunk = substr($this->data, $i, 3);
            $chunkBits = str_pad(decbin((int)$chunk), strlen($chunk) * 3 + 1, '0', STR_PAD_LEFT);
            $binaryData .= $chunkBits;
        }

        return $binaryData;
    }
}
