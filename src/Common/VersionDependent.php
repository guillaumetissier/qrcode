<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\Version;

interface VersionDependent
{
    public function withVersion(Version $version): self;
}
