<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

class TopRightVersionInfoPositions extends AbstractInfoModulePositions
{
    /**
     * ISO/IEC 18004:2000(E) - 8.10 - p.55
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

        $colOffset = $this->version->size() - 11;
        for ($row = 0; $row < 6; $row++) {
            for ($col = 0; $col < 3; $col++) {
                yield Position::fromTopLeft($colOffset + $col, $row);
            }
        }
    }
}
