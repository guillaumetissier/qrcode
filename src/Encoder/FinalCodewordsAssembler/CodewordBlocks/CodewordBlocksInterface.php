<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface CodewordBlocksInterface
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    /**
     * @return list<array{int, ErrorCorrectionCodePerBlock}>
     */
    public function getBlocks(): array;
}
