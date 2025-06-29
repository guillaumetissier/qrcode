<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class DataCodewordPositions extends AbstractSizeDependentPositions
{
    public function getPositions(): \Generator
    {
        $direction = 1;
        $size = $this->getSize();
        $max = $size * ($size - 1);
        $row = 0;
        for ($i = 0; $i < $max; $i++) {
            $column = 2 * floor($i / (2 * $size)) + $i % 2;
            if ($column >= $size - 7) {
                $column++;
            }
            yield new Position($column, $row);
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
