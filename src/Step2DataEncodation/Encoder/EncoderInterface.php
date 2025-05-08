<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation\Encoder;

interface EncoderInterface
{
    function setData(string $data);

    function encode(): string;
}
