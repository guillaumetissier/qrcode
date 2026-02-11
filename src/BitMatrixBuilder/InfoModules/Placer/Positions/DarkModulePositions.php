<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class DarkModulePositions implements InfoModulePositionsInterface
{
    private ?Version $version = null;

    public function withVersion(Version $version): InfoModulePositionsInterface
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return Generator<Position>
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        if (null === $this->version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        yield Position::fromBottomLeft(8, 7, $this->version->size());
    }
}
