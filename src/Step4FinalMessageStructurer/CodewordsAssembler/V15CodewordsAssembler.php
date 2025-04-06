<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 38, table 14
 */
class V15CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [5, new CodewordsAssemblerUnit(109, 87, 11)],
                    [1, new CodewordsAssemblerUnit(110, 88, 11)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [5, new CodewordsAssemblerUnit(65, 41, 12)],
                    [5, new CodewordsAssemblerUnit(66, 42, 12)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [5, new CodewordsAssemblerUnit(54, 24, 15)],
                    [7, new CodewordsAssemblerUnit(55, 25, 15)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [11, new CodewordsAssemblerUnit(36, 12, 12)],
                    [7, new CodewordsAssemblerUnit(37, 13, 12)],
                ],
            ],
            $logger
        );
    }
}
