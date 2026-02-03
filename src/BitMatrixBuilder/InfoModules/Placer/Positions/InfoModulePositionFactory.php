<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\Enums\InformationModule;

final class InfoModulePositionFactory implements InfoModulePositionFactoryInterface
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function createInfoModulePositions(InformationModule $informationModule): InfoModulePositionsInterface
    {
        return match ($informationModule) {
            InformationModule::BOTTOM_LEFT_VERSION_INFO => new BottomLeftVersionInfoPositions(),
            InformationModule::TOP_RIGHT_VERSION_INFO => new TopRightVersionInfoPositions(),
            InformationModule::HORIZONTAL_FORMAT_INFO => new HorizontalFormatInfoPositions(),
            InformationModule::VERTICAL_FORMAT_INFO => new VerticalFormatInfoPositions(),
        };
    }
}
