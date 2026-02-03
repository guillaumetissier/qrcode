<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Placer\Positions;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\BottomLeftVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\HorizontalFormatInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\TopRightVersionInfoPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\VerticalFormatInfoPositions;
use Guillaumetissier\QrCode\Enums\InformationModule;
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
     * @param class-string $expectedClass
     *
     * @dataProvider dataCreateInfoModulePositions
     */
    public function testCreateInfoModulePositions(InformationModule $informationModule, string $expectedClass): void
    {
        $this->assertInstanceOf(
            $expectedClass,
            $this->factory->createInfoModulePositions($informationModule)
        );
    }

    public static function dataCreateInfoModulePositions(): \Generator
    {
        yield [InformationModule::BOTTOM_LEFT_VERSION_INFO, BottomLeftVersionInfoPositions::class];
        yield [InformationModule::HORIZONTAL_FORMAT_INFO, HorizontalFormatInfoPositions::class];
        yield [InformationModule::TOP_RIGHT_VERSION_INFO, TopRightVersionInfoPositions::class];
        yield [InformationModule::VERTICAL_FORMAT_INFO, VerticalFormatInfoPositions::class];
    }
}
