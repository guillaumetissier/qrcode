<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use Generator;
use Guillaumetissier\QrCode\BitString\Padding;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use PHPUnit\Framework\TestCase;

class PaddingTest extends TestCase
{
    public function testCreateReturnsInstance(): void
    {
        $this->assertInstanceOf(Padding::class, Padding::create());
    }

    public function testCreateWithLogger(): void
    {
        $logger = $this->createMock(IOLoggerInterface::class);

        $this->assertInstanceOf(Padding::class, Padding::create($logger));
    }

    public function testWithTotalCodewordsReturnsFluentInterface(): void
    {
        $padding = Padding::create();

        $this->assertSame($padding, $padding->withTotalCodewords(10));
    }

    public function testWithDataBitCountReturnsFluentInterface(): void
    {
        $padding = Padding::create();

        $this->assertSame($padding, $padding->withDataBitCount(26));
    }

    public function testBitStringThrowsExceptionWhenDataBitCountNotSet(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'dataBitCount' missing");

        Padding::create()->withTotalCodewords(10)->bitString();
    }

    public function testBitStringThrowsExceptionWhenTotalCodewordsNotSet(): void
    {
        $this->expectException(MissingInfoException::class);
        $this->expectExceptionMessage("Info 'totalCodewords' missing");

        Padding::create()->withDataBitCount(37)->bitString();
    }

    /**
     * @param int $dataBitCount
     * @param int $totalCodewords
     * @param string $expectedBitString
     * @param int $expectedBitCount
     * @return void
     * @throws MissingInfoException
     * @dataProvider dataBitString
     */
    public function testBitString(
        int $dataBitCount,
        int $totalCodewords,
        string $expectedBitString,
        int $expectedBitCount
    ): void {
        $result = Padding::create()
            ->withDataBitCount($dataBitCount)
            ->withTotalCodewords($totalCodewords)
            ->bitString();

        $this->assertEquals($expectedBitString, $result->toString());
        $this->assertEquals($expectedBitCount, $result->bitCount());
    }

    /**
     * @return Generator<string, array{int, int, string, int}>
     */
    public static function dataBitString(): Generator
    {
        yield 'Returns zero padding when bit count is multiple of 8' => [
            48,
            6,
            '',
            0
        ];

        yield 'Adds zero padding to make multiple of 8' => [
            45,
            6,
            '000',
            3
        ];

        yield 'Adds codeword padding' => [
            40,
            6,
            BitStringFormatter::normalize('11101100'),
            8
        ];

        yield 'Alternates codewords padding' => [
            24,
            6,
            BitStringFormatter::normalize('11101100 00010001 11101100'),
            24
        ];

        yield 'Adds zeros and alternates codewords padding' => [
            21,
            8,
            BitStringFormatter::normalize('000 11101100 00010001 11101100 00010001 11101100'),
            43
        ];
    }
}
