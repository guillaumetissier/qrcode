<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class HorizontalTimingPatternPositions extends AbstractPatternPositions
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

        for ($i = 0; $i < $this->version->size(); $i++) {
            yield Position::fromTopLeft($i, 6);
        }
    }
}
