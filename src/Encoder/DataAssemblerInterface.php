<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;

interface DataAssemblerInterface
{
    /**
     * @param DataBlockInterface[] $dataBlocks
     * @param BitStringInterface[] $ecBlocks
     * @return BitStringInterface
     */
    public function assemble(array $dataBlocks, array $ecBlocks): BitStringInterface;
}
