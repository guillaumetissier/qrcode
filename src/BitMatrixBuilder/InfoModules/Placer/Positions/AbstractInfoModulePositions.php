<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

abstract class AbstractInfoModulePositions implements InfoModulePositionsInterface
{
    use VersionDependentTrait;

    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    abstract public function positions(): Generator;
}
