<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\DataCodewords;

use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;

class Placer extends AbstractPatternPlacer
{
    private ?string $data = null;

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return QrMatrix
     * @throws NoDataException
     */
    public function place(): QrMatrix
    {
        if (null === $this->data) {
            throw new NoDataException();
        }

        $size = $this->matrix->getSize();
        $x = $size - 1;
        $y = $size - 1;
        $direction = -1;

        foreach (str_split($this->data) as $bit) {
            while ($this->matrix->isset($y, $x)) {
                $x -= 2;
                if ($x < 0) {
                    $x = $size - 1;
                    $y -= 2;
                    $direction = -$direction;
                }
                $y += $direction;
            }
            $this->matrix->set($y, $x, (bool)$bit);
        }

        return $this->matrix;
    }
}
