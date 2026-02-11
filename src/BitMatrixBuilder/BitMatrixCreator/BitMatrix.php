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

    private int $size;

    private bool $showValues = false;

    public static function empty(int $size): self
    {
        return new self(array_fill(0, $size, array_fill(0, $size, null)));
    }

    public static function zeros(int $size): self
    {
        return new self(array_fill(0, $size, array_fill(0, $size, 0)));
    }

    public static function ones(int $size): self
    {
        return new self(array_fill(0, $size, array_fill(0, $size, 1)));
    }

    public static function fromMatrix(BitMatrix $matrix): self
    {
        return new self($matrix->toArray());
    }

    /**
     * @param list<list<int|null>> $array
     */
    public static function fromArray(array $array): self
    {
        return new self($array);
    }

    /**
     * @param list<list<int|null>> $array
     */
    private function __construct(array $array)
    {
        $this->matrix = $array;
        $this->size = count($array);
    }

    private function __clone()
    {
    }

    public function showValues(): self
    {
        $this->showValues = true;

        return $this;
    }

    public function size(): int
    {
        return $this->size;
    }

    public function setValue(Position $position, int|bool|null $value): self
    {
        $this->matrix[$position->row()][$position->col()] = $value === null ? null : (int)$value;

        return $this;
    }

    public function value(int $row, int $col): ?int
    {
        return $this->matrix[$row][$col];
    }

    /**
     * @return Generator<array{Position, int|null}>
     */
    public function values(): Generator
    {
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                yield [Position::fromTopLeft($col, $row), $this->matrix[$row][$col]];
            }
        }
    }

    /**
     * @param int $row
     * @return Generator<int|null>
     */
    public function rowValues(int $row): Generator
    {
        for ($col = 0; $col < $this->size; $col++) {
            yield $this->matrix[$row][$col];
        }
    }

    /**
     * @param int $col
     * @return Generator<int|null>
     */
    public function colValues(int $col): Generator
    {
        for ($row = 0; $row < $this->size; $row++) {
            yield $this->matrix[$row][$col];
        }
    }

    /**
     * @return list<list<int|null>>
     */
    public function toArray(): array
    {
        return $this->matrix;
    }

    public function __toString(): string
    {
        $string = '';
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                $val = $this->matrix[$row][$col];
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
}
