<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

interface CodewordsAssemblerInterface
{
    public function assemble(string $dataCodewords, string $errorCodewords): string;
}
