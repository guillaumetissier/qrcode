<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V02CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(44, 34, 4)]
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [1, new ErrorCorrectionCodePerBlock(44, 28, 8)]
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [1, new ErrorCorrectionCodePerBlock(44, 22, 11)]
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [1, new ErrorCorrectionCodePerBlock(44, 16, 14)]
            ],
        ]);
    }
}
