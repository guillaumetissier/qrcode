<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericHighVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericLowVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericMediumVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\AlphanumericQuartileVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteHighVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteLowVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteMediumVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\ByteQuartileVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\NumericHighVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\NumericLowVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\NumericMediumVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\NumericQuartileVersionSelector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\VersionSelectorFactory;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;

class VersionSelectorFactoryTest extends LoggerTestCase
{
    private VersionSelectorFactory $factory;

    public function setUp(): void
    {
        parent::setUp();

        $this->factory = VersionSelectorFactory::create($this->logger);
    }

    /**
     * @param Mode $mode
     * @param ErrorCorrectionLevel $errorCorrectionLevel
     * @param class-string $expectedClass
     * @return void
     * @dataProvider dataGetVersionSelector
     */
    public function testGetVersionSelector(
        Mode $mode,
        ErrorCorrectionLevel $errorCorrectionLevel,
        string $expectedClass
    ): void {
        $this->assertInstanceOf($expectedClass, $this->factory->getVersionSelector($mode, $errorCorrectionLevel));
    }

    /**
     * @return array<array{Mode, ErrorCorrectionLevel, class-string}>
     */
    public static function dataGetVersionSelector(): array
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
