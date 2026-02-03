<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class RightExtensionPatternPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        if (!$this->version instanceof Version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        $patternCount = floor($this->version->value / 2);
        $size = $this->version->size();

        for ($i = 0, $firstRow = 8; $i < $patternCount; $i++, $firstRow += 8) {
            for ($row = 0; $row < 4; $row++) {
                for ($col = 0; $col < 2; $col++) {
                    yield Position::fromBottomRight($col, $firstRow + $row, $size);
                }
            }
        }
    }
}
