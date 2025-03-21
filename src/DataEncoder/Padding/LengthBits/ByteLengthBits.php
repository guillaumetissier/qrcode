<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

class ByteLengthBits extends AbstractLengthBits
{
    public function getLengthBits(): string
    {
        if ($this->version->value <= 9) {
            return str_pad(decbin($this->dataLength), 8, '0', STR_PAD_LEFT);
        }

        return str_pad(decbin($this->dataLength), 16, '0', STR_PAD_LEFT);
    }
}
