<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
class V08CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(121, 97, 12)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [2, new CodewordsAssemblerUnit(60, 38, 11)],
                    [2, new CodewordsAssemblerUnit(61, 39, 11)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [4, new CodewordsAssemblerUnit(40, 18, 9)],
                    [2, new CodewordsAssemblerUnit(41, 19, 9)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [4, new CodewordsAssemblerUnit(40, 14, 13)],
                    [2, new CodewordsAssemblerUnit(41, 15, 13)],
                ],
            ],
            $logger
        );
    }
}
