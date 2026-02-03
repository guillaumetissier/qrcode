<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter;

use Guillaumetissier\QrCode\Enums\Version;

interface DataCodewordsCounterInterface
{
    public function withVersion(?Version $version): self;

    public function count(): int;
}
