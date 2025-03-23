<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

class ByteLengthBits extends AbstractLengthBits
{
    public function getLengthBits(): string
    {
        $this->logger->debug("Input << Version {$this->version->value}");

        if ($this->version->value <= 9) {
            $lengthBits = str_pad(decbin($this->dataLength), 8, '0', STR_PAD_LEFT);
        } else {
            $lengthBits = str_pad(decbin($this->dataLength), 16, '0', STR_PAD_LEFT);
        }

        $this->logger->debug("Output >> Length bits = $lengthBits");

        return $lengthBits;
    }
}
