<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V16CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [5, new CodewordsAssemblerUnit(122, 98, 12)],
                    [1, new CodewordsAssemblerUnit(123, 99, 12)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [7, new CodewordsAssemblerUnit(73, 45, 14)],
                    [3, new CodewordsAssemblerUnit(74, 46, 14)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [15, new CodewordsAssemblerUnit(43, 19, 12)],
                    [2, new CodewordsAssemblerUnit(44, 20, 12)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [3, new CodewordsAssemblerUnit(45, 15, 15)],
                    [13, new CodewordsAssemblerUnit(46, 16, 15)],
                ],
            ],
            $logger
        );
    }
}
