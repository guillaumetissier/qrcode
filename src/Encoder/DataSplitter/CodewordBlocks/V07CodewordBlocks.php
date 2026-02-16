<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
final class V07CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(98, 78, 10)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [4, new ErrorCorrectionCodePerBlock(49, 31, 9)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [2, new ErrorCorrectionCodePerBlock(32, 14, 9)],
                [4, new ErrorCorrectionCodePerBlock(33, 15, 9)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [4, new ErrorCorrectionCodePerBlock(39, 13, 13)],
                [1, new ErrorCorrectionCodePerBlock(40, 14, 13)],
            ],
        ]);
    }
}
