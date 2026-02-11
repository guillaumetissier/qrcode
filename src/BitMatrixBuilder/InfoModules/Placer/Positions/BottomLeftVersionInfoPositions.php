<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

class BottomLeftVersionInfoPositions extends AbstractInfoModulePositions
{
    /**
     * ISO/IEC 18004:2000(E) - 8.10 - p.55
     *
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        if (!$this->version instanceof Version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        if ($this->version < Version::V07) {
            return null;
        }

        for ($col = 0; $col <= 5; $col++) {
            for ($row = 10; $row >= 8; $row--) {
                yield Position::fromBottomLeft($col, $row, $this->version->size());
            }
        }
    }
}
