<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

class AlphanumericLengthBits extends AbstractLengthBits
{
    public function getLengthBits(): string
    {
        if ($this->version->value <= 9) {
            return str_pad(decbin($this->dataLength), 9, '0', STR_PAD_LEFT);
        }

        if ($this->version->value >= 10 && $this->version->value <= 26) {
            return str_pad(decbin($this->dataLength), 11, '0', STR_PAD_LEFT);
        }

        return str_pad(decbin($this->dataLength), 13, '0', STR_PAD_LEFT);
    }
}
