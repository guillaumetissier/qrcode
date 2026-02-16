<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Tests\Encoder\DataSplitter;

use Generator;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataSplitter;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class DataSplitterTest extends TestCase
{
    private DataSplitter $splitter;

    protected function setUp(): void
    {
        $this->splitter = DataSplitter::create();
    }

    /**
     * @param Version $version
     * @param ErrorCorrectionLevel $ecl
     * @param BitStringInterface $dataCodewords
     * @param array<BitStringInterface> $expected
     * @return void
     *
     * @throws MissingInfoException
     *
     * @dataProvider dataSplit
     */
    public function testSplit(
        Version $version,
        ErrorCorrectionLevel $ecl,
        BitStringInterface $dataCodewords,
        array $expected
    ): void {
        $result = $this->splitter
            ->withVersion($version)
            ->withErrorCorrectionLevel($ecl)
            ->split($dataCodewords);

        $this->assertCount(count($expected), $result);

        foreach ($expected as $i => $expectedBlock) {
            $this->assertSame(
                $expectedBlock->toString(),
                $result[$i]->data()->toString(),
                "Block $i does not match"
            );
        }
    }

    /**
     * @return Generator<array{Version, ErrorCorrectionLevel, BitStringInterface, array<BitStringInterface>}>
     */
    public static function dataSplit(): Generator
    {
        // V01-L : 1 block of 19 data codewords
        yield 'V01-L: 1 block of 19 codewords' => [
            Version::V01,
            ErrorCorrectionLevel::LOW,
            BitString::fromString(str_repeat('10110001', 19)),
            [
                BitString::fromString(str_repeat('10110001', 19)),
            ]
        ];

        // V01-H : 1 block of 9 data codewords
        yield 'V01-H: 1 block of 9 codewords' => [
            Version::V01,
            ErrorCorrectionLevel::HIGH,
            BitString::fromString(str_repeat('10110001', 9)),
            [
                BitString::fromString(str_repeat('10110001', 9)),
            ]
        ];

        // V05-M : 2 blocks of 43 data codewords each
        yield 'V05-M: 2 blocks of 43 codewords' => [
            Version::V05,
            ErrorCorrectionLevel::MEDIUM,
            BitString::fromString(
                str_repeat('10110100', 43) . // block 1
                str_repeat('01001011', 43)   // block 2
            ),
            [
                BitString::fromString(str_repeat('10110100', 43)),
                BitString::fromString(str_repeat('01001011', 43)),
            ]
        ];

        // V05-Q : 2 blocks of 15 + 2 blocks of 16 data codewords
        // Group 1 : [2 blocks × 15 codewords] = 30 codewords
        // Group 2 : [2 blocks × 16 codewords] = 32 codewords
        // Total : 62 codewords
        yield 'V05-Q: 2 blocks of 15 + 2 blocks of 16 codewords' => [
            Version::V05,
            ErrorCorrectionLevel::QUARTILE,
            BitString::fromString(
                str_repeat('11001100', 15) . // block 1 (15 codewords)
                str_repeat('00110011', 15) . // block 2 (15 codewords)
                str_repeat('10101010', 16) . // block 3 (16 codewords)
                str_repeat('01010101', 16)   // block 4 (16 codewords)
            ),
            [
                BitString::fromString(str_repeat('11001100', 15)),
                BitString::fromString(str_repeat('00110011', 15)),
                BitString::fromString(str_repeat('10101010', 16)),
                BitString::fromString(str_repeat('01010101', 16)),
            ]
        ];

        // V05-H : 2 blocks of 11 + 2 blocks of 12 data codewords
        // Group 1 : [2 blocks × 11 codewords] = 22 codewords
        // Group 2 : [2 blocks × 12 codewords] = 24 codewords
        // Total : 46 codewords
        yield 'V05-H: 2 blocks of 11 + 2 blocks of 12 codewords' => [
            Version::V05,
            ErrorCorrectionLevel::HIGH,
            BitString::fromString(
                str_repeat('11110000', 11) . // block 1 (11 codewords)
                str_repeat('00001111', 11) . // block 2 (11 codewords)
                str_repeat('10100101', 12) . // block 3 (12 codewords)
                str_repeat('01011010', 12)   // block 4 (12 codewords)
            ),
            [
                BitString::fromString(str_repeat('11110000', 11)),
                BitString::fromString(str_repeat('00001111', 11)),
                BitString::fromString(str_repeat('10100101', 12)),
                BitString::fromString(str_repeat('01011010', 12)),
            ]
        ];

        // V05-L : 1 block of 108 data codewords
        yield 'V05-L: 1 block of 108 codewords' => [
            Version::V05,
            ErrorCorrectionLevel::LOW,
            BitString::fromString(str_repeat('10110001', 108)),
            [
                BitString::fromString(str_repeat('10110001', 108)),
            ]
        ];
    }
}
