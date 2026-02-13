<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class TopRightVersionInfoPositions extends AbstractInfoModulePositions
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
        $colOffset = $this->version()->size() - 11;
        for ($row = 0; $row < 6; $row++) {
            for ($col = 0; $col < 3; $col++) {
                yield Position::fromTopLeft($colOffset + $col, $row);
            }
        }
    }
}
