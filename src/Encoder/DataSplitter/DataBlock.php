<?php

namespace Guillaumetissier\QrCode\Encoder\DataSplitter;

use Guillaumetissier\BitString\BitStringInterface;

final class DataBlock implements DataBlockInterface
{
    public function __construct(
        private readonly BitStringInterface $data,
        private readonly int $numErrorCorrectionCodewords,
    ) {
    }

    /**
     * @return BitStringInterface
     */
    public function data(): BitStringInterface
    {
        return $this->data;
    }

    public function numErrorCorrectionCodewords(): int
    {
        return $this->numErrorCorrectionCodewords;
    }
}
