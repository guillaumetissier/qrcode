<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
final class V12CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [2, new ErrorCorrectionCodePerBlock(116, 92, 12)],
                [2, new ErrorCorrectionCodePerBlock(117, 93, 12)],
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [6, new ErrorCorrectionCodePerBlock(58, 36, 11)],
                [2, new ErrorCorrectionCodePerBlock(59, 37, 11)],
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [4, new ErrorCorrectionCodePerBlock(46, 20, 13)],
                [6, new ErrorCorrectionCodePerBlock(47, 21, 13)],
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [7, new ErrorCorrectionCodePerBlock(42, 14, 14)],
                [4, new ErrorCorrectionCodePerBlock(43, 15, 14)],
            ],
        ]);
    }
}
