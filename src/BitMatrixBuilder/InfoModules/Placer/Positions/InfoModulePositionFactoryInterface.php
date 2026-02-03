<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\Enums\InformationModule;

interface InfoModulePositionFactoryInterface
{
    public function createInfoModulePositions(InformationModule $informationModule): InfoModulePositionsInterface;
}
