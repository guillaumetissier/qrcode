<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class FinderPatternCenterPositions extends AbstractPatternPositions
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

        yield Position::fromTopLeft(3, 3);
        yield Position::fromTopLeft($this->version->size() - 4, 3);
        yield Position::fromTopLeft(3, $this->version->size() - 4);
    }
}
