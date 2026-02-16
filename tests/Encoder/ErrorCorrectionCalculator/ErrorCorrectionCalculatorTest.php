<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlock;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\ErrorCorrectionCalculator;
use PHPUnit\Framework\TestCase;

class ErrorCorrectionCalculatorTest extends TestCase
{
    private ErrorCorrectionCalculator $errorCorrectionCalculator;

    protected function setUp(): void
    {
        $this->errorCorrectionCalculator = ErrorCorrectionCalculator::create();
    }

    /**
     * @param string $bitString
     * @param int $numEcCodewords
     * @param string $expected
     * @return void
     *
     * @dataProvider dataCalculateErrorCorrection
     */
    public function testCalculateErrorCorrection(string $bitString, int $numEcCodewords, string $expected): void
    {
        $this->assertEquals(
            $expected,
            $this->errorCorrectionCalculator->calculateErrorCorrection(
                new DataBlock(BitString::fromString($bitString), $numEcCodewords)
            )->toString()
        );
    }

    /**
     * @return array<array{string, int, string}>
     */
    public static function dataCalculateErrorCorrection(): array
    {
        return [
            [
                BitStringFormatter::normalize(
                    '01000010 00000110 11110110 01100010 00000100 10110110 00010110 11010110' . PHP_EOL .
                    '10010110 11000110 00010010 11100010 00000100 00010110 11100110 01000010' . PHP_EOL .
                    '00000110 11010111 10010010 00000111 00110110 11110110 11100010 00000110' . PHP_EOL .
                    '10010111 00110010 00000100 10100111 01010110 11000110 10010110 00010110' . PHP_EOL .
                    '11100010 00000110 00010110 11100110 01000010'
                ),
                22,
                BitStringFormatter::normalize(
                    '00001001 11110011 01000110 10100010 00001101 10010100 11100011 00110010' . PHP_EOL .
                    '00100111 01010000 11100011 11101111 00010011 01000110 00011000 01111010' . PHP_EOL .
                    '00110010 01101010 01111101 01110100 01101110 10110001'
                )
            ]
        ];
    }
}
