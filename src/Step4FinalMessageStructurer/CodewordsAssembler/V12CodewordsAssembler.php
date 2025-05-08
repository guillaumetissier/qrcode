<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 37, table 14
 */
class V12CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(116, 92, 12)],
                    [2, new CodewordsAssemblerUnit(117, 93, 12)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [6, new CodewordsAssemblerUnit(58, 36, 11)],
                    [2, new CodewordsAssemblerUnit(59, 37, 11)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [4, new CodewordsAssemblerUnit(46, 20, 13)],
                    [6, new CodewordsAssemblerUnit(47, 21, 13)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [7, new CodewordsAssemblerUnit(42, 14, 14)],
                    [4, new CodewordsAssemblerUnit(43, 15, 14)],
                ],
            ],
            $logger
        );
    }
}
