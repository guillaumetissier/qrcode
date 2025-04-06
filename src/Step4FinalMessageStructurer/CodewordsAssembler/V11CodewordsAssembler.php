<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V11CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [4, new CodewordsAssemblerUnit(101, 81, 10)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [1, new CodewordsAssemblerUnit(80, 50, 15)],
                    [4, new CodewordsAssemblerUnit(81, 51, 15)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [4, new CodewordsAssemblerUnit(50, 22, 14)],
                    [4, new CodewordsAssemblerUnit(51, 23, 14)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [3, new CodewordsAssemblerUnit(36, 12, 12)],
                    [8, new CodewordsAssemblerUnit(37, 13, 12)],
                ],
            ],
            $logger
        );
    }
}
