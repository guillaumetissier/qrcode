<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacerInterface;
use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;

interface InfoModulePlacerFactoryInterface
{
    public function createInfoModulePlacer(
        InformationModule $informationModule,
        Version $version
    ): ?InfoModulePlacerInterface;
}
