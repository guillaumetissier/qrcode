<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\SizeDependentPositionsInterface;

final class DataCodewordPositions implements SizeDependentPositionsInterface
{
    private ?int $size = null;

    public function withSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Generator<Position>
     */
    public function positions(): Generator
    {
        $direction = 1;
        $size = $this->size;
        $max = $size * ($size - 1);
        $row = 0;
        for ($i = 0; $i < $max; $i++) {
            $column = 2 * (int)floor($i / (2 * $size)) + $i % 2;
            if ($column >= $size - 7) {
                $column++;
            }
            yield Position::fromBottomRight($column, $row, $this->size);
            if ($i % 2 === 1) {
                $row += $direction;
                if ($row === $size) {
                    $direction = -1;
                    $row = $size - 1;
                } elseif ($row === -1) {
                    $direction = 1;
                    $row = 0;
                }
            }
        }
    }
}
