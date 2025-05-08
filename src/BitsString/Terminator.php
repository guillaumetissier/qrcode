<?php

namespace ThePhpGuild\QrCode\BitsString;

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
