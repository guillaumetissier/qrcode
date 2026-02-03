<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

abstract class AbstractInfoModulePositions implements InfoModulePositionsInterface
{
    protected ?Version $version = null;

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    abstract public function positions(): Generator;
}
