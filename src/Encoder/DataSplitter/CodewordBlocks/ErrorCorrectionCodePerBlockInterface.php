<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

interface ErrorCorrectionCodePerBlockInterface
{
    public function totalNumCodewords(): int;

    public function numDataCodewords(): int;

    public function numErrorCorrectionCodewords(): int;

    public function numErrorCorrectionCapacity(): int;
}
