<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
final class V14CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [3, new ErrorCorrectionCodePerBlock(145, 115, 15)],
                [1, new ErrorCorrectionCodePerBlock(146, 116, 15)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [4, new ErrorCorrectionCodePerBlock(64, 40, 12)],
                [5, new ErrorCorrectionCodePerBlock(65, 41, 12)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [11, new ErrorCorrectionCodePerBlock(36, 16, 10)],
                [5, new ErrorCorrectionCodePerBlock(37, 17, 10)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [11, new ErrorCorrectionCodePerBlock(36, 12, 12)],
                [5, new ErrorCorrectionCodePerBlock(37, 13, 12)],
            ],
        ]);
    }
}
