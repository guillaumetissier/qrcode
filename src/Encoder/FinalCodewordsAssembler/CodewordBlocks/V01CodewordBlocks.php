<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
final class V01CodewordBlocks extends BaseCodewordBlocks
{
    public function __construct()
    {
        parent::__construct([
            ErrorCorrectionLevel::LOW->value => [
                [1, new ErrorCorrectionCodePerBlock(26, 19, 2)]
            ],
            ErrorCorrectionLevel::MEDIUM->value => [
                [1, new ErrorCorrectionCodePerBlock(26, 16, 4)]
            ],
            ErrorCorrectionLevel::QUARTILE->value => [
                [1, new ErrorCorrectionCodePerBlock(26, 13, 6)]
            ],
            ErrorCorrectionLevel::HIGH->value => [
                [1, new ErrorCorrectionCodePerBlock(26, 9, 8)]
            ],
        ]);
    }
}
