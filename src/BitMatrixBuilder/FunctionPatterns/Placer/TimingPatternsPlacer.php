<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositionsInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class TimingPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix, NonDataPositionsInterface $functionPatternPositions): void
    {
        $i = 0;
        foreach ($this->positions() as $position) {
            $matrix->setValue($position, $i % 2 === 0);
            $functionPatternPositions->addPosition($position);
            $i++;
        }
    }
}
