<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class RightExtensionPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingParameter
     */
    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            $matrix->setValue($position, $position->col() % 2 === 0);
            $functionPatternPositions->addPosition($position);
        }
    }
}
