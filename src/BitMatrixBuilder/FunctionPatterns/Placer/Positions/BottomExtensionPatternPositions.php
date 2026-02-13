<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class BottomExtensionPatternPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        $version = $this->version();
        $patternCount = floor($version->value / 2);
        $size = $version->size();
        for ($i = 0, $firstCol = 8; $i < $patternCount; $i++, $firstCol += 8) {
            for ($col = 0; $col < 4; $col++) {
                for ($row = 0; $row < 2; $row++) {
                    yield Position::fromBottomRight($firstCol + $col, $row, $size);
                }
            }
        }
    }
}
