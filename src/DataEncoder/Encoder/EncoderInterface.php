<?php

namespace ThePhpGuild\Qrcode\DataEncoder\Encoder;

interface EncoderInterface
{
    function setData(string $data);

    function encode(): string;
}
