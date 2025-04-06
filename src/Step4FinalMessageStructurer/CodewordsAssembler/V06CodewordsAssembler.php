<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V06CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(86, 68, 9)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [4, new CodewordsAssemblerUnit(43, 27, 8)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [4, new CodewordsAssemblerUnit(43, 19, 12)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [4, new CodewordsAssemblerUnit(43, 15, 14)],
                ],
            ],
            $logger
        );
    }
}
