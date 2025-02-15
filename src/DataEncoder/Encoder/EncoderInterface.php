<?php

namespace ThePhpGuild\QrCode\DataEncoder\Encoder;

interface EncoderInterface
{
    function setData(string $data);

    function encode(): string;
}
