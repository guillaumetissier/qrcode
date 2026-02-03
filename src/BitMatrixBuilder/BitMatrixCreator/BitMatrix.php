<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator;

use Generator;
use Guillaumetissier\QrCode\Common\Position;

class BitMatrix
{
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

    public static function fromArray(array $array): self
    {
        return new self($array);
    }

    private function __construct(array $arg)
    {
        $this->matrix = $arg;
        $this->size = count($arg);
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

    public function setValue(Position $position, bool|int|string|null $value): self
    {
        $this->matrix[$position->row()][$position->col()] = $value;

        return $this;
    }

    public function getValueFromTopLeft(int $row, int $col): bool|int|string|null
    {
        return $this->matrix[$row][$col];
    }

    public function getRowValuesFromTopLeft(int $row): Generator
    {
        for ($col = 0; $col < $this->size; $col++) {
            yield $this->matrix[$row][$col];
        }
    }

    public function getColValuesFromTopLeft(int $col): Generator
    {
        for ($row = 0; $row < $this->size; $row++) {
            yield $this->matrix[$row][$col];
        }
    }

    public function getValueFromBottomRight(int $row, int $col): bool|int|string|null
    {
        return $this->matrix[$this->size - $row - 1][$this->size - $col - 1];
    }

    public function toArray(): array
    {
        return $this->matrix;
    }

    /**
     * @return Generator<array{Position, int}>
     */
    public function getValuesFromTopLeft(): Generator
    {
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                yield [Position::fromTopLeft($col, $row), $this->matrix[$row][$col]];
            }
        }
    }

    public function __toString(): string
    {
        $string = '';
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                $val = $this->matrix[$row][$col];
                if ($this->showValues) {
                    if (null === $val) {
                        $string .= 'x';
                    } elseif (is_bool($val)) {
                        $string .= $val ? '█' : ' ';
                    } else {
                        $string .= $val;
                    }
                } elseif ($val) {
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
