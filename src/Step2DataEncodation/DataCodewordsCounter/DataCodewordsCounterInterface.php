<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\Version;

interface DataCodewordsCounterInterface
{
    public function setVersion(?Version $version): self;

    public function count(): int;
}
