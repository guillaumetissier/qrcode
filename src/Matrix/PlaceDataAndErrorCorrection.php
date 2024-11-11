<?php

namespace ThePhpGuild\Qrcode\Matrix;

class PlaceDataAndErrorCorrection extends AbstractPlacePatterns
{
    private $data = null;

    public function setData($data): void
    {
        $this->data = $data;
    }

    public function execute(): QrMatrix
    {
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
