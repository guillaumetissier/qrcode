<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;

interface InfoModulePositionFactoryInterface
{
    public function createInfoModulePositions(
        InformationModule $informationModule,
        Version $version,
    ): ?InfoModulePositionsInterface;
}
