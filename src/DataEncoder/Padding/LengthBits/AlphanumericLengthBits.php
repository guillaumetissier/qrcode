<?php

namespace ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits;

class AlphanumericLengthBits extends AbstractLengthBits
{
    public function getLengthBits(): string
    {
        $this->logger->debug("Input << Version {$this->version->value}");

        if ($this->version->value <= 9) {
            $lengthBits = str_pad(decbin($this->dataLength), 9, '0', STR_PAD_LEFT);
        } else if ($this->version->value <= 26) {
            $lengthBits = str_pad(decbin($this->dataLength), 11, '0', STR_PAD_LEFT);
        } else {
            $lengthBits = str_pad(decbin($this->dataLength), 13, '0', STR_PAD_LEFT);
        }

        $this->logger->info("Output >> Length bits = $lengthBits");

        return $lengthBits;
    }
}
