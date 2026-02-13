<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;

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

    public function createInfoModulePositions(
        InformationModule $informationModule,
        Version $version
    ): ?InfoModulePositionsInterface {
        $hasVersionInfo = $version->value >= Version::V07->value;

        $informationModule = match ($informationModule) {
            InformationModule::BOTTOM_LEFT_VERSION_INFO =>
                $hasVersionInfo ? new BottomLeftVersionInfoPositions() : null,
            InformationModule::TOP_RIGHT_VERSION_INFO =>
                $hasVersionInfo ? new TopRightVersionInfoPositions() : null,
            InformationModule::HORIZONTAL_FORMAT_INFO => new HorizontalFormatInfoPositions(),
            InformationModule::VERTICAL_FORMAT_INFO => new VerticalFormatInfoPositions(),
            InformationModule::DARK_MODULE => new DarkModulePositions(),
        };

        return $informationModule?->withVersion($version);
    }
}
