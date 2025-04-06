<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

/**
 * ISO/IEC 18004:2000(E) p. 35, table 14
 */
class V02CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [1, new CodewordsAssemblerUnit(44, 34, 4)]
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [1, new CodewordsAssemblerUnit(44, 28, 8)]
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [1, new CodewordsAssemblerUnit(44, 22, 11)]
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [1, new CodewordsAssemblerUnit(44, 16, 14)]
                ],
            ],
            $logger
        );
    }
}
