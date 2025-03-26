<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler\CodewordsAssemblerUnit;

class CodewordsAssemblerUnitTest extends TestCase
{
    private CodewordsAssemblerUnit $codewordsAssemblerUnit;

    public function setUp(): void
    {
        $this->codewordsAssemblerUnit = new CodewordsAssemblerUnit(20, 15, 5);
    }

    public function testAssemble()
    {
        $this->assertEquals(
            'PQRSTUVWXYZabcd56789',
            $this->codewordsAssemblerUnit
                ->setErrorOffset(5)
                ->setDataOffset(15)
                ->assemble('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvw', '0123456789')
        );
    }
}
