<?php

namespace ThePhpGuild\QrCode\BitsString;

interface BitsStringInterface extends \Stringable
{
    public function bitsCount(): int;
}
