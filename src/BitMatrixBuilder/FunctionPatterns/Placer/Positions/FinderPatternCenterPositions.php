<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class FinderPatternCenterPositions extends AbstractPatternPositions
{
    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        $version = $this->version();
        yield Position::fromTopLeft(3, 3);
        yield Position::fromTopLeft($version->size() - 4, 3);
        yield Position::fromTopLeft(3, $version->size() - 4);
    }
}
