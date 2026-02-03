<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\DataCodewordsPlacer;

use Generator;
use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer\DataCodewordPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer\DataCodewordPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

class DataCodewordPlacerTest extends TestCase
{
    /**
     * @param int $size
     * @param array<Position> $alreadySetPositions
     * @param string $data
     * @param string $expectedMatrix
     * @return void
     * @throws MissingInfoException
     * @dataProvider dataPlace
     */
    public function testPlace(int $size, array $alreadySetPositions, string $data, string $expectedMatrix): void
    {
        $matrix = BitMatrix::empty($size);
        $matrix->showValues();
        $dataCodewords = DataCodewordPlacer::create();
        $dataCodewords
            ->withData($this->mockBitString($data))
            ->place($matrix, FunctionPatternPositions::fromArray($alreadySetPositions));

        $this->assertEquals($expectedMatrix, "$matrix");
    }

    /**
     * @return Generator<array{int, array<Position>, string, string}>
     */
    public static function dataPlace(): Generator
    {
        yield [
            25,
            [],
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890',

            '210921x092109210921092109' . PHP_EOL .
            '438743x874387438743874387' . PHP_EOL .
            '656565x656565656565656565' . PHP_EOL .
            '874387x438743874387438743' . PHP_EOL .
            '092109x210921092109210921' . PHP_EOL .
            '210921x092109210921092109' . PHP_EOL .
            '438743x874387438743874387' . PHP_EOL .
            '656565x656565656565656565' . PHP_EOL .
            '874387x438743874387438743' . PHP_EOL .
            '092109x210921092109210921' . PHP_EOL .
            '210921x092109210921092109' . PHP_EOL .
            '438743x874387438743874387' . PHP_EOL .
            '656565x656565656565656565' . PHP_EOL .
            '874387x438743874387438743' . PHP_EOL .
            '092109x210921092109210921' . PHP_EOL .
            '210921x092109210921092109' . PHP_EOL .
            '438743x874387438743874387' . PHP_EOL .
            '656565x656565656565656565' . PHP_EOL .
            '874387x438743874387438743' . PHP_EOL .
            '092109x210921092109210921' . PHP_EOL .
            '210921x092109210921092109' . PHP_EOL .
            '438743x874387438743874387' . PHP_EOL .
            '656565x656565656565656565' . PHP_EOL .
            '874387x438743874387438743' . PHP_EOL .
            '092109x210921092109210921' . PHP_EOL,


        ];

        yield [
            25,
            [
                Position::fromBottomRight(0, 20, 25), Position::fromBottomRight(1, 20, 25),
                Position::fromBottomRight(2, 20, 25), Position::fromBottomRight(3, 20, 25),
                Position::fromBottomRight(4, 20, 25), Position::fromBottomRight(0, 21, 25),
                Position::fromBottomRight(1, 21, 25), Position::fromBottomRight(2, 21, 25),
                Position::fromBottomRight(3, 21, 25), Position::fromBottomRight(4, 21, 25),

                Position::fromBottomRight(0, 22, 25), Position::fromBottomRight(1, 22, 25),
                Position::fromBottomRight(2, 22, 25), Position::fromBottomRight(3, 22, 25),
                Position::fromBottomRight(4, 22, 25), Position::fromBottomRight(0, 23, 25),
                Position::fromBottomRight(1, 23, 25), Position::fromBottomRight(2, 23, 25),
                Position::fromBottomRight(3, 23, 25), Position::fromBottomRight(4, 23, 25),

                Position::fromBottomRight(0, 24, 25), Position::fromBottomRight(1, 24, 25),
                Position::fromBottomRight(2, 24, 25), Position::fromBottomRight(3, 24, 25),
                Position::fromBottomRight(4, 24, 25), Position::fromBottomRight(20, 0, 25),
                Position::fromBottomRight(21, 0, 25), Position::fromBottomRight(22, 0, 25),
                Position::fromBottomRight(23, 0, 25), Position::fromBottomRight(24, 0, 25),

                Position::fromBottomRight(20, 1, 25), Position::fromBottomRight(21, 1, 25),
                Position::fromBottomRight(22, 1, 25), Position::fromBottomRight(23, 1, 25),
                Position::fromBottomRight(24, 1, 25), Position::fromBottomRight(20, 2, 25),
                Position::fromBottomRight(21, 2, 25), Position::fromBottomRight(22, 2, 25),
                Position::fromBottomRight(23, 2, 25), Position::fromBottomRight(24, 2, 25),

                Position::fromBottomRight(20, 3, 25), Position::fromBottomRight(21, 3, 25),
                Position::fromBottomRight(22, 3, 25), Position::fromBottomRight(23, 3, 25),
                Position::fromBottomRight(24, 3, 25), Position::fromBottomRight(20, 4, 25),
                Position::fromBottomRight(21, 4, 25), Position::fromBottomRight(22, 4, 25),
                Position::fromBottomRight(23, 4, 25), Position::fromBottomRight(24, 4, 25),

                Position::fromBottomRight(20, 20, 25), Position::fromBottomRight(21, 20, 25),
                Position::fromBottomRight(22, 20, 25), Position::fromBottomRight(23, 20, 25),
                Position::fromBottomRight(24, 20, 25), Position::fromBottomRight(20, 21, 25),
                Position::fromBottomRight(21, 21, 25), Position::fromBottomRight(22, 21, 25),
                Position::fromBottomRight(23, 21, 25), Position::fromBottomRight(24, 21, 25),

                Position::fromBottomRight(20, 22, 25), Position::fromBottomRight(21, 22, 25),
                Position::fromBottomRight(22, 22, 25), Position::fromBottomRight(23, 22, 25),
                Position::fromBottomRight(24, 22, 25), Position::fromBottomRight(20, 23, 25),
                Position::fromBottomRight(21, 23, 25), Position::fromBottomRight(22, 23, 25),
                Position::fromBottomRight(23, 23, 25), Position::fromBottomRight(24, 23, 25),

                Position::fromBottomRight(20, 24, 25), Position::fromBottomRight(21, 24, 25),
                Position::fromBottomRight(22, 24, 25), Position::fromBottomRight(23, 24, 25),
                Position::fromBottomRight(24, 24, 25),
            ],
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890' .
            '12345678901234567890123456789012345678901234567890',

            'xxxxx6x5476547654765xxxxx' . PHP_EOL .
            'xxxxx7x3298329832984xxxxx' . PHP_EOL .
            'xxxxx8x1010101010103xxxxx' . PHP_EOL .
            'xxxxx9x9832983298322xxxxx' . PHP_EOL .
            'xxxxx0x7654765476541xxxxx' . PHP_EOL .
            '765421x547654765476092109' . PHP_EOL .
            '983243x329832983298874387' . PHP_EOL .
            '101065x101010101010656565' . PHP_EOL .
            '329887x983298329832438743' . PHP_EOL .
            '547609x765476547654210921' . PHP_EOL .
            '765421x547654765476092109' . PHP_EOL .
            '983243x329832983298874387' . PHP_EOL .
            '101065x101010101010656565' . PHP_EOL .
            '329887x983298329832438743' . PHP_EOL .
            '547609x765476547654210921' . PHP_EOL .
            '765421x547654765476092109' . PHP_EOL .
            '983243x329832983298874387' . PHP_EOL .
            '101065x101010101010656565' . PHP_EOL .
            '329887x983298329832438743' . PHP_EOL .
            '547609x765476547654210921' . PHP_EOL .
            'xxxxx1x547654765476092109' . PHP_EOL .
            'xxxxx2x329832983298874387' . PHP_EOL .
            'xxxxx3x101010101010656565' . PHP_EOL .
            'xxxxx4x983298329832438743' . PHP_EOL .
            'xxxxx5x765476547654210921' . PHP_EOL,
        ];
    }

    private function mockBitString(string $value): BitStringInterface
    {
        return new class ($value) implements BitStringInterface {
            public function __construct(private readonly string $value)
            {
            }

            public function get(int $index): int
            {
                return (int)$this->value[$index];
            }

            public function set(int $index, int $value): BitStringInterface
            {
                return $this;
            }

            public function flip(int $index): BitStringInterface
            {
                return $this;
            }

            public function length(): int
            {
                return strlen($this->value);
            }

            public function bitCount(): int
            {
                return strlen($this->value);
            }

            public function and(BitStringInterface $other): BitStringInterface
            {
                return $this;
            }

            public function or(BitStringInterface $other): BitStringInterface
            {
                return $this;
            }

            public function xor(BitStringInterface $other): BitStringInterface
            {
                return $this;
            }

            public function not(): BitStringInterface
            {
                return $this;
            }

            public function shiftLeft(int $positions, bool $circular = false): BitStringInterface
            {
                return $this;
            }

            public function shiftRight(int $positions, bool $circular = false): BitStringInterface
            {
                return $this;
            }

            public function rotateLeft(int $positions): BitStringInterface
            {
                return $this;
            }

            public function rotateRight(int $positions): BitStringInterface
            {
                return $this;
            }

            public function popCount(): int
            {
                return 0;
            }

            public function prepend(string|BitStringInterface $other): BitStringInterface
            {
                return $this;
            }

            public function append(string|BitStringInterface $other): BitStringInterface
            {
                return $this;
            }

            public function equals(string|BitStringInterface $other): bool
            {
                return true;
            }

            public function toString(): string
            {
                return $this->value;
            }

            public function extract(int $position, int $length): BitStringInterface
            {
                return $this;
            }

            public function slice(int $start, int $end): BitStringInterface
            {
                return $this;
            }

            public function first(int $length): BitStringInterface
            {
                return $this;
            }

            public function last(int $length): BitStringInterface
            {
                return $this;
            }

            public function codeword(int $index, int $wordLength): BitStringInterface
            {
                return $this;
            }

            public function __toString(): string
            {
                return $this->value;
            }
        };
    }
}
