<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

class HorizontalFormatInfoPositions extends AbstractInfoModulePositions
{
    /**
     * ISO/IEC 18004:2000(E) - 8.9 - p.54
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

        $size = $this->version->size();
        $row = 8;

        for ($col = 0; $col <= 7; $col++) {
            yield Position::fromTopRight($col, $row, $size);
        }

        yield Position::fromTopLeft(7, $row);

        for ($col = 5; $col >= 0; $col--) {
            yield Position::fromTopLeft($col, $row);
        }
    }
}
