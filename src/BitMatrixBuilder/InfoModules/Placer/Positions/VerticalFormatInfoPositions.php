<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class VerticalFormatInfoPositions extends AbstractInfoModulePositions
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
        $col = 8;
        $size = $this->version()->size();

        for ($row = 0; $row <= 8; $row++) {
            if ($row === 6) {
                continue;
            }
            yield Position::fromTopLeft($col, $row);
        }

        for ($row = 6; $row >= 0; $row--) {
            yield Position::fromBottomLeft($col, $row, $size);
        }
    }
}
