<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Version;

interface VersionInfoBuilderInterface
{
    public function withVersion(Version $version): self;

    public function build(): ?BitStringInterface;
}
