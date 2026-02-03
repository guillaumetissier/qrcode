<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class BottomExtensionPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix, FunctionPatternPositionsInterface $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            $matrix->setValue($position, $position->row() % 2 === 0);
            $functionPatternPositions->addPosition($position);
        }
    }
}
