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

        for ($i = 0; $i < 8; $i++) {
            yield Position::fromTopLeft($size - $i - 1, 8);
        }

        for ($i = 0; $i < 9; $i++) {
            if (8 - $i === 6) {
                continue;
            }
            yield Position::fromTopLeft(8 - $i, 8);
        }
    }
}
