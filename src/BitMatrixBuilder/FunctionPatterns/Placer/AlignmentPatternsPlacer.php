<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class AlignmentPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix, FunctionPatternPositionsInterface $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            for ($row = -2; $row <= 2; $row++) {
                for ($col = -2; $col <= 2; $col++) {
                    $matrix->setValue(
                        $pos = Position::fromTopLeft($position->col() + $col, $position->row() + $row),
                        (abs($row) == 2 || abs($col) == 2 || ($row == 0 && $col == 0))
                    );
                    $functionPatternPositions->addPosition($pos);
                }
            }
        }
    }
}
