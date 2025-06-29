<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

use Stringable;

class Position implements Stringable
{
    public function __construct(private readonly int $col, private readonly int $row)
    {}

    public function getCol(): int
    {
        return $this->col;
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function equals(int $col, int $row): bool
    {
        return $this->col === $col && $this->row === $row;
    }

    public function __toString(): string
    {
        return "Pos({$this->col}, {$this->row})";
    }
}
