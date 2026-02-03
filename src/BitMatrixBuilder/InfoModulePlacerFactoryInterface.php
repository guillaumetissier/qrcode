<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacerInterface;
use Guillaumetissier\QrCode\Enums\InformationModule;

interface InfoModulePlacerFactoryInterface
{
    public function createInfoModulePlacer(InformationModule $informationModule): InfoModulePlacerInterface;
}
