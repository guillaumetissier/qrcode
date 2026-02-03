<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\QrCode\Enums\Mode;

interface ModeDetectorInterface
{
    public function withData(string $data): self;

    public function detect(): Mode;
}
