<?php

namespace Tests\BitsString;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\DataBits;

class DataBitsTest extends TestCase
{
    public function testAppend(): void
    {
        $dataBits = new DataBits('010111001010');
        $dataBits->append('010001000010101');
        $this->assertEquals('01011100 10100100 01000010 101', "$dataBits");
    }

    public function testPrepend(): void
    {
        $dataBits = new DataBits('11101110111');
        $dataBits->prepend('10011111101010100');
        $this->assertEquals('10011111 10101010 01110111 0111', "$dataBits");
    }

    public function testPadLastCodeword(): void
    {
        $dataBits = new DataBits('1110111011100101010101111');
        $dataBits->padLastCodeword();
        $this->assertEquals('11101110 11100101 01010111 10000000', "$dataBits");
    }

    public function testToString(): void
    {
        $dataBits = new DataBits('1110111011100101010101010101010');
        $this->assertEquals('11101110 11100101 01010101 0101010', "$dataBits");
    }

    public function testBitsCount(): void
    {
        $dataBits = new DataBits('1110111011100101010101010');
        $this->assertEquals(25, $dataBits->bitsCount());
    }

    public function testGetCodewordsCount(): void
    {
        $dataBits = new DataBits('11101110111001010101011110000000');
        $this->assertEquals(4, $dataBits->getCodewordsCount());
    }

    public function testToCodewords(): void
    {
        $dataBits = new DataBits('11101110111001010101011110000000');
        $this->assertEquals(['11101110', '11100101', '01010111', '10000000'], $dataBits->toCodewords());
    }
}
