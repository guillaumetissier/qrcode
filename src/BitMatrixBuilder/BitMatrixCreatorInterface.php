<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\Enums\Version;

interface BitMatrixCreatorInterface
{
    public function withVersion(Version $version): self;

    public function createEmptyMatrix(): BitMatrix;
}
