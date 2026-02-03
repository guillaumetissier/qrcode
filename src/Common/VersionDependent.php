<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Version;

interface VersionDependent
{
    public function withVersion(Version $version): self;
}
