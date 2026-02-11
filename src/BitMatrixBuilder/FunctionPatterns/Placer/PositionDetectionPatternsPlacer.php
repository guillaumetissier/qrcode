<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class PositionDetectionPatternsPlacer extends AbstractPatternsPlacer
{
    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix, NonDataPositionsInterface $functionPatternPositions): void
    {
        foreach ($this->positions() as $position) {
            for ($row = -4; $row <= 4; $row++) {
                for ($col = -4; $col <= 4; $col++) {
                    if (
                        ($position->col() + $col < 0) ||
                        ($position->row() + $row < 0) ||
                        ($position->col() + $col > $matrix->size() - 1) ||
                        ($position->row() + $row > $matrix->size() - 1)
                    ) {
                        continue;
                    }
                    $pos = Position::fromTopLeft($position->col() + $col, $position->row() + $row);
                    $matrix->setValue(
                        $pos,
                        (abs($row) == 3 || abs($col) == 3 || (abs($row) <= 1 && abs($col) <= 1)) &&
                        abs($col) !== 4 && abs($row) !== 4
                    );
                    $functionPatternPositions->addPosition($pos);
                }
            }
        }
    }
}
