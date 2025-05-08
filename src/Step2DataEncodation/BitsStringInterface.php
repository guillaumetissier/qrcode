<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

interface BitsStringInterface extends \Stringable
{
    public function bitsCount(): int;
}
