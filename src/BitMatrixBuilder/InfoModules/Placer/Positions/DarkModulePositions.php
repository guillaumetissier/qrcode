<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class DarkModulePositions implements InfoModulePositionsInterface
{
    use VersionDependentTrait;

    /**
     * @return Generator<Position>
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        yield Position::fromBottomLeft(8, 7, $this->version()->size());
    }
}
