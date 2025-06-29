<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Exception\NoDataException;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\Position;

class DataCodewordsPlacer extends AbstractPositionDependentPatternsPlacer
{
    private ?string $data = null;

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @throws NoDataException
     */
    public function place(Matrix $matrix): void
    {
        if (null === $this->data) {
            throw new NoDataException();
        }

        $data = str_split($this->data);
        $index = 0;
        /** @var Position $position */
        foreach ($this->getPositions() as $position) {
            if (!$matrix->isValueFromBottomRightSet($position)) {
                $matrix->setValueFromBottomRight($position, $data[$index++]);
            }
        }
    }
}
