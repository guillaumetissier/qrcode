<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

class ByteEncoder extends AbstractEncoder
{
    public function encode(): string
    {
        $binaryData = '';
        $length = strlen($this->data);

        $this->logger->input("{$this->data} (length: {$length})", ['class' => static::class]);

        for ($i = 0; $i < $length; $i++) {
            $binaryData .= str_pad(decbin(ord($this->data[$i])), 8, '0', STR_PAD_LEFT);
        }

        $this->logger->output($binaryData);

        return $binaryData;
    }
}
