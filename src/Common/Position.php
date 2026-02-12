<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Stringable;

final class Position implements Stringable
{
    public static function fromTopLeft(int $col, int $row): Position
    {
        return new Position($col, $row);
    }

    public static function fromTopRight(int $col, int $row, int $size): Position
    {
        return new Position($size - $col - 1, $row);
    }

    public static function fromBottomLeft(int $col, int $row, int $size): Position
    {
        return new Position($col, $size - $row - 1);
    }

    public static function fromBottomRight(int $col, int $row, int $size): Position
    {
        return new Position($size - $col - 1, $size - $row - 1);
    }

    private function __construct(private readonly int $col, private readonly int $row)
    {
    }

    public function col(): int
    {
        return $this->col;
    }

    public function row(): int
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

    public function toInt(): int
    {
        return 1000 * $this->row + $this->col;
    }
}
