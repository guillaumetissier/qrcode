<?php

namespace ThePhpGuild\QrCode\Matrix;

class Matrix
{
    private array $matrix;

    private int $size;

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

    public function getSize(): int
    {
        return $this->size;
    }

    public function setValueFromTopLeft(int $row, int $col, bool|int|null $value): self
    {
        $this->matrix[$row][$col] = $value;

        return $this;
    }

    public function setValueFromBottomRight(int $row, int $col, bool|int|null $value): self
    {
        $this->matrix[$this->size - $row - 1][$this->size - $col - 1] = $value;

        return $this;
    }

    public function getValueFromTopLeft(int $row, int $col): bool|int|null
    {
        return $this->matrix[$row][$col];
    }

    public function getValueFromBottomRight(int $row, int $col): bool|int|null
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
                $string .= $this->matrix[$row][$col] ? '█' : ' ';
            }
            $string .= PHP_EOL;
        }

        return $string;
    }
}
