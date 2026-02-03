<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

class VerticalFormatInfoPositions extends AbstractInfoModulePositions
{
    /**
     * ISO/IEC 18004:2000(E) - 8.9 - p.54
     *
     * @return Generator<Position>
     *
     * @throws MissingParameter
     */
    public function positions(): Generator
    {
        if (!$this->version instanceof Version) {
            throw MissingParameter::missingParameter('version', self::class);
        }

        for ($i = 0; $i < 9; $i++) {
            if ($i === 6) {
                continue;
            }
            yield Position::fromTopLeft(8, $i);
        }

        $size = $this->version->size();
        for ($i = 0; $i < 8; $i++) {
            yield Position::fromTopLeft(8, $size - 8 + $i);
        }
    }
}
