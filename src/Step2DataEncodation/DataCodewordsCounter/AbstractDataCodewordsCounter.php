<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;

use ThePhpGuild\QrCode\Enums\Version;

abstract class AbstractDataCodewordsCounter implements DataCodewordsCounterInterface
{
    protected ?Version $version = null;

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function count(): int;
}