<?php

namespace Tests\DataEncoder\Version\Selector;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Mode\Mode;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\AlphanumericHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\AlphanumericLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\AlphanumericMediumVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\AlphanumericQuartileVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteMediumVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\ByteQuartileVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericHighVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericLowVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericMediumVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\NumericQuartileVersionSelector;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;

class VersionSelectorFactoryTest extends LoggerTestCase
{
    private VersionSelectorFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = new VersionSelectorFactory($this->logger);
    }

    /**
     * @dataProvider provideDataToGetVersionSelector
     */
    public function testGetVersionSelector(
        Mode $mode,
        ErrorCorrectionLevel $errorCorrectionLevel,
        string $expectedClass
    ): void
    {
        $this->assertInstanceOf($expectedClass, $this->factory->getVersionSelector($mode, $errorCorrectionLevel));
    }

    public static function provideDataToGetVersionSelector(): array
    {
        return [
            [Mode::ALPHANUMERIC, ErrorCorrectionLevel::LOW, AlphanumericLowVersionSelector::class],
            [Mode::ALPHANUMERIC, ErrorCorrectionLevel::MEDIUM, AlphanumericMediumVersionSelector::class],
            [Mode::ALPHANUMERIC, ErrorCorrectionLevel::QUARTILE, AlphanumericQuartileVersionSelector::class],
            [Mode::ALPHANUMERIC, ErrorCorrectionLevel::HIGH, AlphanumericHighVersionSelector::class],

            [Mode::BYTE, ErrorCorrectionLevel::LOW, ByteLowVersionSelector::class],
            [Mode::BYTE, ErrorCorrectionLevel::MEDIUM, ByteMediumVersionSelector::class],
            [Mode::BYTE, ErrorCorrectionLevel::QUARTILE, ByteQuartileVersionSelector::class],
            [Mode::BYTE, ErrorCorrectionLevel::HIGH, ByteHighVersionSelector::class],

            [Mode::NUMERIC, ErrorCorrectionLevel::LOW, NumericLowVersionSelector::class],
            [Mode::NUMERIC, ErrorCorrectionLevel::MEDIUM, NumericMediumVersionSelector::class],
            [Mode::NUMERIC, ErrorCorrectionLevel::QUARTILE, NumericQuartileVersionSelector::class],
            [Mode::NUMERIC, ErrorCorrectionLevel::HIGH, NumericHighVersionSelector::class],
        ];
    }
}
