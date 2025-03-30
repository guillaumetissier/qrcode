<?php

namespace ThePhpGuild\QrCode\Matrix;

use ThePhpGuild\QrCode\Exception\NoDataException;

class DataAndErrorCorrectionDrawer extends AbstractPatternDrawer
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
    public function draw(): QrMatrix
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
