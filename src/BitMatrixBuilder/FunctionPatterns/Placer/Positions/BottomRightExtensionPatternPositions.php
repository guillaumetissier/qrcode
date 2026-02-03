<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class BottomRightExtensionPatternPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingParameter
     */
    public function positions(): Generator
    {
        if (!$this->version instanceof Version) {
            throw MissingParameter::missingParameter('version', self::class);
        }

        $size = $this->version->size();
        for ($col = 0; $col < 2; $col++) {
            for ($row = 0; $row < 2; $row++) {
                yield Position::fromBottomRight($col, $row, $size);
            }
        }
    }
}
