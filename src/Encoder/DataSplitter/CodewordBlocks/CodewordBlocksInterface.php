<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface CodewordBlocksInterface
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    /**
     * @return list<array{int, ErrorCorrectionCodePerBlock}>
     */
    public function getBlocks(): array;
}
