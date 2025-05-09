<?php

namespace Tests\BitsString;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\BitsStringInterface;
use ThePhpGuild\QrCode\BitsString\DataBits;
use ThePhpGuild\QrCode\Enums\NumeralSystem;

class DataBitsTest extends TestCase
{

    /**
     * @dataProvider provideDataToTestConstruct
     */
    public function testConstruct(BitsStringInterface|string|array $initial, string $expected): void
    {
        $dataBits = new DataBits($initial);
        $this->assertEquals($expected, "$dataBits");
    }

    public static function provideDataToTestConstruct(): \Generator
    {
        yield [new DataBits('010001000010101'), '01000100 0010101'];
        yield [new DataBits('0100 01000010 101'), '01000100 0010101'];
        yield [new DataBits(['0000', '11111', '000000', '11111111']), '00001111 10000001 1111111'];
        yield ['0100 0100 0010 1010', '01000100 00101010'];
        yield [['1111', '00001111'], '11110000 1111'];
        yield [['01000100', '00001111'], '01000100 00001111'];
        yield [[234, 40, 199], '11101010 00101000 11000111'];
    }

    /**
     * @dataProvider provideDataToTestAppend
     */
    public function testAppend(BitsStringInterface|string|array $appended, string $expected): void
    {
        $dataBits = new DataBits('010111001010');
        $dataBits->append($appended);
        $this->assertEquals($expected, "$dataBits");
    }

    public static function provideDataToTestAppend(): \Generator
    {
        yield ['010001000010101', '01011100 10100100 01000010 101'];
        yield [new DataBits('010001000010101'), '01011100 10100100 01000010 101'];
        yield [['01000100', '00001111'], '01011100 10100100 01000000 1111'];
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
        $this->assertEquals([238, 229, 87, 128], $dataBits->toCodewords(NumeralSystem::DECIMAL));
    }
}
