<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

final class ErrorCorrectionCodePerBlock implements ErrorCorrectionCodePerBlockInterface
{
    public function __construct(
        private readonly int $totalNumCodewords,
        private readonly int $numDataCodewords,
        private readonly int $numErrorCorrectionCapacity,
    ) {
    }

    public function totalNumCodewords(): int
    {
        return $this->totalNumCodewords;
    }

    public function numDataCodewords(): int
    {
        return $this->numDataCodewords;
    }

    public function numErrorCorrectionCodewords(): int
    {
        return $this->totalNumCodewords - $this->numDataCodewords;
    }

    public function numErrorCorrectionCapacity(): int
    {
        return $this->numErrorCorrectionCapacity;
    }
}
