<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
final class V17CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(135, 107, 14)],
                [5, new ErrorCorrectionCodePerBlock(136, 108, 14)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [10, new ErrorCorrectionCodePerBlock(74, 46, 14)],
                [1, new ErrorCorrectionCodePerBlock(75, 47, 14)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [1, new ErrorCorrectionCodePerBlock(50, 22, 14)],
                [15, new ErrorCorrectionCodePerBlock(51, 23, 14)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [2, new ErrorCorrectionCodePerBlock(42, 14, 14)],
                [17, new ErrorCorrectionCodePerBlock(43, 15, 14)],
            ],
        ]);
    }
}
