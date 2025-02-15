<?php

namespace ThePhpGuild\QrCode\Matrix;

class PlaceFinderPatterns extends AbstractPlacePatterns
{
    public function execute(): QrMatrix
    {
        $positions = [[0, 0], [0, $this->matrix->getSize() - 7], [$this->matrix->getSize() - 7, 0]];

        foreach ($positions as [$row, $col]) {
            for ($i = 0; $i < 7; $i++) {
                for ($j = 0; $j < 7; $j++) {
                    $this->matrix->set(
                        $row + $i,
                        $col + $j,
                        $i == 0 || $i == 6 || $j == 0 || $j == 6 || ($i >= 2 && $i <= 4 && $j >= 2 && $j <= 4)
                    );
                }
            }
        }

        return $this->matrix;
    }
}