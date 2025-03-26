<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

interface CodewordsAssemblerInterface
{
    public function assemble(string $dataCodewords, string $errorCodewords): string;
}
