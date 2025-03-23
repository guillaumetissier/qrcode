<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

class NumericLengthBits extends AbstractLengthBits
{
    public function getLengthBits(): string
    {
        $this->logger->debug("Input << Version {$this->version->value}");

        if ($this->version->value <= 9) {
            $lengthBits = str_pad(decbin($this->dataLength), 10, '0', STR_PAD_LEFT);
        } else if ($this->version->value >= 10 && $this->version->value <= 26) {
            $lengthBits = str_pad(decbin($this->dataLength), 12, '0', STR_PAD_LEFT);
        } else {
            $lengthBits = str_pad(decbin($this->dataLength), 14, '0', STR_PAD_LEFT);
        }

        $this->logger->debug("Output >> Length bits = $lengthBits");

        return $lengthBits;
    }
}
