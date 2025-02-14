<?php

namespace ThePhpGuild\Qrcode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class QrMatrix
{
    private array $matrix = [];
    private int $size;

    public function __construct(Version $version)
    {
        $this->size = 21 + 4 * ($version->toInt() - 1);
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
