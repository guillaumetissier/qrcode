<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Enums\Version;

abstract class AbstractDataCodewordsCounter implements DataCodewordsCounterInterface
{
    protected ?Version $version = null;

    public function withVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    abstract public function count(): int;
}
