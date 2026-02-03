<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModulePlacerFactoryInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactoryInterface;
use Guillaumetissier\QrCode\Enums\InformationModule;

final class InfoModulePlacerFactory implements InfoModulePlacerFactoryInterface
{
    public static function create(): self
    {
        return new self(InfoModulePositionFactory::create());
    }

    private function __construct(private readonly InfoModulePositionFactoryInterface $positionFactory)
    {
    }

    private function __clone()
    {
    }

    public function createInfoModulePlacer(InformationModule $informationModule): InfoModulePlacerInterface
    {
        $positions = $this->positionFactory->createInfoModulePositions($informationModule);

        return match ($informationModule) {
            InformationModule::BOTTOM_LEFT_VERSION_INFO,
            InformationModule::TOP_RIGHT_VERSION_INFO,
            InformationModule::HORIZONTAL_FORMAT_INFO,
            InformationModule::VERTICAL_FORMAT_INFO => new InfoModulePlacer($positions),
        };
    }
}
