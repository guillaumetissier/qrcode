<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class PositionDetectionPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix, FunctionPatternPositionsInterface $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            for ($row = -3; $row <= 3; $row++) {
                for ($col = -3; $col <= 3; $col++) {
                    $pos = Position::fromTopLeft($position->col() + $col, $position->row() + $row);
                    $matrix->setValue(
                        $pos,
                        abs($row) == 3 || abs($col) == 3 || (abs($row) <= 1 && abs($col) <= 1)
                    );
                    $functionPatternPositions->addPosition($pos);
                }
            }
        }
    }
}
