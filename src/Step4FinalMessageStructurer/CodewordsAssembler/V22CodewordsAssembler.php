<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 39, table 14
 */
class V22CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(139, 111, 14)],
                    [7, new CodewordsAssemblerUnit(140, 112, 14)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [17, new CodewordsAssemblerUnit(74, 46, 14)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [7, new CodewordsAssemblerUnit(54, 24, 15)],
                    [16, new CodewordsAssemblerUnit(55, 25, 15)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [34, new CodewordsAssemblerUnit(37, 13, 12)],
                ],
            ],
            $logger
        );
    }
}
