<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class BottomRightExtensionPatternPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        $size = $this->version()->size();
        for ($col = 0; $col < 2; $col++) {
            for ($row = 0; $row < 2; $row++) {
                yield Position::fromBottomRight($col, $row, $size);
            }
        }
    }
}
