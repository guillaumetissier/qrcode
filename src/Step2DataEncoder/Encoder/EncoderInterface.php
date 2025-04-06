<?php

namespace ThePhpGuild\QrCode\Step2DataEncoder\Encoder;

interface EncoderInterface
{
    function setData(string $data);

    function encode(): string;
}
