<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V20CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [3, new CodewordsAssemblerUnit(135, 107, 14)],
                    [5, new CodewordsAssemblerUnit(136, 108, 14)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [3, new CodewordsAssemblerUnit(67, 41, 13)],
                    [13, new CodewordsAssemblerUnit(68, 42, 13)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [15, new CodewordsAssemblerUnit(54, 24, 15)],
                    [5, new CodewordsAssemblerUnit(55, 25, 15)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [15, new CodewordsAssemblerUnit(43, 15, 14)],
                    [10, new CodewordsAssemblerUnit(44, 16, 14)],
                ],
            ],
            $logger
        );
    }
}
