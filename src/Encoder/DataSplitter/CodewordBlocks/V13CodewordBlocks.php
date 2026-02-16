<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
final class V13CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [4, new ErrorCorrectionCodePerBlock(133, 107, 13)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [8, new ErrorCorrectionCodePerBlock(59, 37, 11)],
                [1, new ErrorCorrectionCodePerBlock(60, 38, 11)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [8, new ErrorCorrectionCodePerBlock(44, 20, 12)],
                [4, new ErrorCorrectionCodePerBlock(45, 21, 12)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [12, new ErrorCorrectionCodePerBlock(33, 11, 11)],
                [4, new ErrorCorrectionCodePerBlock(34, 12, 11)],
            ],
        ]);
    }
}
