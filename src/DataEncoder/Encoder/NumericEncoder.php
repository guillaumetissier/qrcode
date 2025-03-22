<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

class NumericEncoder extends AbstractEncoder
{
    public function encode(): string
    {
        $binaryData = '';
        $length = strlen($this->data);

        $this->logger->debug("Input << {$this->data} (length: {$length})");

        for ($i = 0; $i < $length; $i += 3) {
            $chunk = substr($this->data, $i, 3);
            $chunkBits = str_pad(decbin((int)$chunk), strlen($chunk) * 3 + 1, '0', STR_PAD_LEFT);
            $binaryData .= $chunkBits;
        }

        $this->logger->debug("Output >> {$binaryData}");

        return $binaryData;
    }
}
