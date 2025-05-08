<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V18CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [5, new CodewordsAssemblerUnit(150, 120, 15)],
                    [1, new CodewordsAssemblerUnit(151, 121, 15)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [9, new CodewordsAssemblerUnit(69, 43, 13)],
                    [4, new CodewordsAssemblerUnit(70, 44, 13)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [17, new CodewordsAssemblerUnit(50, 22, 14)],
                    [1, new CodewordsAssemblerUnit(51, 23, 14)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [2, new CodewordsAssemblerUnit(42, 14, 14)],
                    [19, new CodewordsAssemblerUnit(43, 15, 14)],
                ],
            ],
            $logger
        );
    }
}
