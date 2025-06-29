<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class Matrix
{
    private array $matrix;

    private int $size;

    private bool $showValues = false;

    public function __construct(int|array $sizeOrData)
    {
        if (is_array($sizeOrData)) {
            $this->matrix = $sizeOrData;
            $this->size = count($sizeOrData);
        } else {
            $this->size = $sizeOrData;
            $this->matrix = array_fill(0, $this->size, array_fill(0, $this->size, null));
        }
    }

    public function showValues(): self
    {
        $this->showValues = true;

        return $this;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function setValueFromTopLeft(Position $position, bool|int|string|null $value): self
    {
        $this->matrix[$position->getRow()][$position->getCol()] = $value;

        return $this;
    }

    public function setValueFromBottomRight(Position $position, bool|int|string|null $value): self
    {
        $col = $this->size - $position->getCol() - 1;
        $row = $this->size - $position->getRow() - 1;
        $this->matrix[$row][$col] = $value;

        return $this;
    }

    public function isValueFromTopLeftSet(Position $position): bool
    {
        return isset($this->matrix[$position->getRow()][$position->getCol()]);
    }

    public function isValueFromBottomRightSet(Position $position): bool
    {
        $col = $this->size - $position->getCol() - 1;
        $row = $this->size - $position->getRow() - 1;
        return isset($this->matrix[$row][$col]);
    }

    public function getValueFromTopLeft(int $row, int $col): bool|int|string|null
    {
        return $this->matrix[$row][$col];
    }

    public function getValueFromBottomRight(int $row, int $col): bool|int|string|null
    {
        return $this->matrix[$this->size - $row - 1][$this->size - $col - 1];
    }

    public function toArray(): array
    {
        return $this->matrix;
    }

    public function getValuesFromTopLeft(): \Generator
    {
        for ($row = 0; $row < $this->size; $row++) {
            for ($col = 0; $col < $this->size; $col++) {
                yield [$row, $col, $this->matrix[$row][$col]];
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
                } else if ($val) {
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
