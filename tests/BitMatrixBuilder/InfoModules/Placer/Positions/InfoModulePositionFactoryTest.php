<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\BottomLeftVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\DarkModulePositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\HorizontalFormatInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\TopRightVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\VerticalFormatInfoPositions;
use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;
use PHPUnit\Framework\TestCase;

class InfoModulePositionFactoryTest extends TestCase
{
    private InfoModulePositionFactory $factory;

    protected function setUp(): void
    {
        $this->factory = InfoModulePositionFactory::create();
    }

    /**
     * @param InformationModule $informationModule
     * @param Version $version
     * @param null|class-string $expectedClass
     *
     * @dataProvider dataCreateInfoModulePositions
     */
    public function testCreateInfoModulePositions(
        InformationModule $informationModule,
        Version $version,
        ?string $expectedClass
    ): void {

        if ($expectedClass === null) {
            $this->assertNull($this->factory->createInfoModulePositions($informationModule, $version));
        } else {
            $this->assertInstanceOf(
                $expectedClass,
                $this->factory->createInfoModulePositions($informationModule, $version)
            );
        }
    }

    public static function dataCreateInfoModulePositions(): \Generator
    {
        yield [InformationModule::BOTTOM_LEFT_VERSION_INFO, Version::V01, null];
        yield [InformationModule::BOTTOM_LEFT_VERSION_INFO, Version::V07, BottomLeftVersionInfoPositions::class];
        yield [InformationModule::BOTTOM_LEFT_VERSION_INFO, Version::V32, BottomLeftVersionInfoPositions::class];
        yield [InformationModule::HORIZONTAL_FORMAT_INFO, Version::V07, HorizontalFormatInfoPositions::class];
        yield [InformationModule::TOP_RIGHT_VERSION_INFO, Version::V02, null];
        yield [InformationModule::TOP_RIGHT_VERSION_INFO, Version::V06, null];
        yield [InformationModule::TOP_RIGHT_VERSION_INFO, Version::V08, TopRightVersionInfoPositions::class];
        yield [InformationModule::VERTICAL_FORMAT_INFO, Version::V13, VerticalFormatInfoPositions::class];
        yield [InformationModule::DARK_MODULE, Version::V06, DarkModulePositions::class];
    }
}
