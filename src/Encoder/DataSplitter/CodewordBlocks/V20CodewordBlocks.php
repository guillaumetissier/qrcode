<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
final class V20CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [3, new ErrorCorrectionCodePerBlock(135, 107, 14)],
                [5, new ErrorCorrectionCodePerBlock(136, 108, 14)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [3, new ErrorCorrectionCodePerBlock(67, 41, 13)],
                [13, new ErrorCorrectionCodePerBlock(68, 42, 13)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [15, new ErrorCorrectionCodePerBlock(54, 24, 15)],
                [5, new ErrorCorrectionCodePerBlock(55, 25, 15)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [15, new ErrorCorrectionCodePerBlock(43, 15, 14)],
                [10, new ErrorCorrectionCodePerBlock(44, 16, 14)],
            ],
        ]);
    }
}
