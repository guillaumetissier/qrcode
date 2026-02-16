<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator;

use Generator;
use Guillaumetissier\QrCode\Common\Position;

class BitMatrix
{
    /**
     * @var list<list<int|null>> $matrix
     */
    private array $matrix;

    /**
     * @var int size of the matrix without the margin
     */
    private int $size;

    /**
     * @var int size of the margin around the data
     */
    private int $margin;

    /**
     * @var bool if true show the value 1, 0 or . (for null)
     */
    private bool $showValues = false;

    public static function empty(int $size, int $margin = 0): self
    {
        return new self(self::buildArrayWithMargin(null, $size, $margin), $margin);
    }

    public static function zeros(int $size, int $margin = 0): self
    {
        $totalSize = $size + 2 * $margin;

        return new self(array_fill(0, $totalSize, array_fill(0, $totalSize, 0)), $margin);
    }

    public static function ones(int $size, int $margin = 0): self
    {
        return new self(self::buildArrayWithMargin(1, $size, $margin), $margin);
    }

    public static function fromMatrix(BitMatrix $matrix): self
    {
        return new self($matrix->toArray(true), $matrix->margin());
    }

    /**
     * @param list<list<int|null>> $array
     */
    public static function fromArray(array $array, int $margin = 0): self
    {
        return new self($array, $margin);
    }

    /**
     * @param list<list<int|null>> $array
     */
    private function __construct(array $array, int $margin = 0)
    {
        $this->matrix = $array;
        $this->size = count($array) - 2 * $margin;
        $this->margin = $margin;
    }

    private function __clone()
    {
    }

    public function showValues(): self
    {
        $this->showValues = true;

        return $this;
    }

    public function size(bool $marginIncluded = false): int
    {
        return $marginIncluded ? $this->size + 2 * $this->margin() : $this->size;
    }

    public function setValue(Position $position, int|bool|null $value): self
    {
        $this->matrix[$this->margin + $position->row()][$this->margin + $position->col()] =
            $value === null ? null : (int)$value;

        return $this;
    }

    public function value(int $row, int $col): ?int
    {
        return $this->matrix[$this->margin + $row][$this->margin + $col];
    }

    public function margin(): int
    {
        return $this->margin;
    }

    /**
     * @return Generator<array{Position, int|null}>
     */
    public function values(bool $marginIncluded = false): Generator
    {
        $size = $this->size($marginIncluded);
        $offset = $marginIncluded ? 0 : $this->margin;

        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                yield [Position::fromTopLeft($col, $row), $this->matrix[$offset + $row][$offset + $col]];
            }
        }
    }

    /**
     * @param int $row
     * @return array<int|null>
     */
    public function rowValues(int $row): array
    {
        return array_slice($this->matrix[$this->margin + $row], $this->margin, $this->size);
    }

    /**
     * @param int $col
     * @return array<int|null>
     */
    public function colValues(int $col): array
    {
        $values = [];
        for ($row = 0; $row < $this->size; $row++) {
            $values[] = $this->matrix[$this->margin + $row][$this->margin + $col];
        }

        return $values;
    }

    /**
     * @return list<list<int|null>>
     */
    public function toArray(bool $marginIncluded = false): array
    {
        if ($marginIncluded) {
            return $this->matrix;
        }

        return
            array_map(
                fn(array $row): array => array_slice($row, $this->margin, $this->size),
                array_slice($this->matrix, $this->margin, $this->size)
            );
    }

    public function toString(bool $marginIncluded = false): string
    {
        $string = '';
        $size = $this->size($marginIncluded);
        $offset = $marginIncluded ? 0 : $this->margin;
        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                $val = $this->matrix[$offset + $row][$offset + $col];
                if ($this->showValues) {
                    $string .= ($val === null ? "." : $val);
                } elseif ($val === 1) {
                    $string .= '█';
                } else {
                    $string .= ' ';
                }
            }
            $string .= PHP_EOL;
        }

        return $string;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param int|null $value
     * @param int $size
     * @param int $margin
     * @return array<array<int|null>>
     */
    private static function buildArrayWithMargin(?int $value, int $size, int $margin): array
    {
        $totalSize = $size + 2 * $margin;

        $internalRow = array_fill(0, $totalSize, $value);
        for ($i = 0; $i < $margin; $i++) {
            $internalRow[$i] = 0;
            $internalRow[$totalSize - $i - 1] = 0;
        }

        $externalRow = array_fill(0, $totalSize, 0);
        $array = array_fill(0, $totalSize, $internalRow);
        for ($i = 0; $i < $margin; $i++) {
            $array[$i] = $externalRow;
            $array[$totalSize - $i - 1] = $externalRow;
        }

        return $array;
    }
}
