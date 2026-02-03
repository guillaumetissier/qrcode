<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class BottomRightExtensionPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingParameter
     */
    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            $matrix->setValue($position, ($position->row() % 2 === 0) && ($position->col() % 2 === 0));
            $functionPatternPositions->addPosition($position);
        }
    }
}
