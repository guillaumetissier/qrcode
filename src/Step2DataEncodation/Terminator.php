<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

class Terminator implements BitsStringInterface
{
    public function __toString(): string
    {
        return '0000';
    }

    public function bitsCount(): int
    {
        return 4;
    }
}
