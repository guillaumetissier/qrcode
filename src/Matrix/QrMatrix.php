<?php

namespace ThePhpGuild\QrCode\Matrix;

class QrMatrix
{
    private array $matrix = [];

    private int $size;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->matrix = array_fill(0, $this->size, array_fill(0, $this->size, null));
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function set(int $x, int $y, bool $value): self
    {
        $this->matrix[$x][$y] = $value;

        return $this;
    }

    public function isset(int $x, int $y): bool
    {
        return $this->matrix[$x][$y] !== null;
    }

    public function getMatrix(): array
    {
        return $this->matrix;
    }

    public function display(): void
    {
        foreach ($this->matrix as $row) {
            foreach ($row as $cell) {
                echo !$cell ? ' ' : '█';
            }
            echo PHP_EOL;
        }
    }
}
