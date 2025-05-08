<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) p. 36, table 14
 */
class V07CodewordsAssembler extends BaseCodewordsAssembler
{
    public function __construct(IOLoggerInterface $logger)
    {
        parent::__construct(
            [
                ErrorCorrectionLevel::LOW->value => [
                    [2, new CodewordsAssemblerUnit(98, 78, 10)],
                ],
                ErrorCorrectionLevel::MEDIUM->value => [
                    [4, new CodewordsAssemblerUnit(49, 31, 9)],
                ],
                ErrorCorrectionLevel::QUARTILE->value => [
                    [2, new CodewordsAssemblerUnit(32, 14, 9)],
                    [4, new CodewordsAssemblerUnit(33, 15, 9)],
                ],
                ErrorCorrectionLevel::HIGH->value => [
                    [4, new CodewordsAssemblerUnit(39, 13, 13)],
                    [1, new CodewordsAssemblerUnit(40, 14, 13)],
                ],
            ],
            $logger
        );
    }
}
