<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class TimingPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingParameter
     */
    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void
    {
        $i = 0;
        foreach ($this->positions() as $position) {
            $matrix->setValue($position, $i % 2 === 0);
            $functionPatternPositions->addPosition($position);
            $i++;
        }
    }
}
