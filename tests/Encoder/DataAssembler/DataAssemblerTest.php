<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAssembler;

use Generator;
use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;
use Guillaumetissier\QrCode\Encoder\DataAssembler\DataAssembler;
use PHPUnit\Framework\TestCase;

final class DataAssemblerTest extends TestCase
{
    private DataAssembler $assembler;

    protected function setUp(): void
    {
        $this->assembler = DataAssembler::create();
    }

    /**
     * @param array<DataBlockInterface> $dataBlocks
     * @param array<BitStringInterface> $ecBlocks
     * @param BitStringImmutable $expected
     * @return void
     *
     * @dataProvider dataAssemble
     */
    public function testAssemble(array $dataBlocks, array $ecBlocks, BitStringImmutable $expected): void
    {
        $this->assertSame($expected->toString(), $this->assembler->assemble($dataBlocks, $ecBlocks)->toString());
    }

    /**
     * @return Generator<array{array<DataBlockInterface>, array<BitStringInterface>, BitStringImmutable}>
     */
    public static function dataAssemble(): Generator
    {
        yield '1 block: no interleaving' => [
            [
                self::makeDataBlock('11110000' . '10101010' . '00001111'),
            ],
            [
                BitString::fromString('11001100' . '00110011'),
            ],
            BitStringImmutable::fromString(
                BitStringFormatter::normalize(
                    // Data Correction codewords
                    '11110000 10101010 00001111' .
                    // Error Correction codewords
                    '11001100 00110011'
                )
            ),
        ];

        yield '2 blocks of same size' => [
            [
                self::makeDataBlock('11110000' . '10101010'),
                self::makeDataBlock('00001111' . '01010101'),
            ],
            [
                BitString::fromString('11001100' . '00110011'),
                BitString::fromString('10011001' . '01100110'),
            ],
            BitStringImmutable::fromString(
                BitStringFormatter::normalize(
                    // Data Correction codewords
                    '11110000 00001111' . // D1 D3
                    '10101010 01010101' . // D2 D4
                    // Error Correction codewords
                    '11001100 10011001' . // E1 E3
                    '00110011 01100110'   // E2 E4
                )
            ),
        ];

        // V05-H 88 2 (33,11,11) *
        //          2 (34,12,11)
        //
        // * (c, k, r): c = total number of codewords
        //              k = number of data codewords
        //              r = number of error correction capacity
        yield '2 groups: blocks of different sizes (V05-H like)' => [
            [
                self::makeDataBlock(str_repeat('11110000', 11)), // block 1 : 11 codewords
                self::makeDataBlock(str_repeat('00001111', 11)), // block 2 : 11 codewords
                self::makeDataBlock(str_repeat('10101010', 12)), // block 3 : 12 codewords
                self::makeDataBlock(str_repeat('01010101', 12)), // block 4 : 12 codewords
            ],
            [
                BitString::fromString(str_repeat('11001100', 11)), // ec block 1
                BitString::fromString(str_repeat('00110011', 11)), // ec block 2
                BitString::fromString(str_repeat('10011001', 11)), // ec block 3
                BitString::fromString(str_repeat('01100110', 11)), // ec block 4
            ],
            BitStringImmutable::fromString(
                BitStringFormatter::normalize(
                    // Data Correction codewords
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '11110000 00001111 10101010 01010101' .
                    '10101010 01010101 ' .
                    // Error Correction codewords
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110' .
                    '11001100 00110011 10011001 01100110'
                )
            ),
        ];
    }

    private static function makeDataBlock(string $bits): DataBlockInterface
    {
        $mock = new class ($bits) implements DataBlockInterface {
            private BitString $data;

            public function __construct(string $bits)
            {
                $this->data = BitString::fromString($bits);
            }

            public function data(): BitString
            {
                return $this->data;
            }

            public function numErrorCorrectionCodewords(): int
            {
                return 0;
            }
        };

        return $mock;
    }
}
