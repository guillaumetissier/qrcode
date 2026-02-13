<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

interface CharCountIndicatorInterface extends BitStringAware
{
    public function withMode(Mode $mode): self;

    public function withVersion(Version $version): self;

    public function withData(string $data): self;
}
