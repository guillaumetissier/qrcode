<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;

interface InfoModulePlacerInterface
{
    public function withData(BitStringInterface $data): self;

    public function place(BitMatrix $matrix): void;
}
