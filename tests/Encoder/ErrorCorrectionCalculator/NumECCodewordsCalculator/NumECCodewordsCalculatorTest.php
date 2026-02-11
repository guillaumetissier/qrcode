<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\ErrorCorrectionCalculator\NumECCodewordsCalculator;

use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\NumECCodewordsCalculator\NumECCodewordsCalculator;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;

class NumECCodewordsCalculatorTest extends LoggerTestCase
{
    private NumECCodewordsCalculator $calculator;

    public function setUp(): void
    {
        parent::setUp();

        $this->calculator = NumECCodewordsCalculator::create($this->logger);
    }

    /**
     * @param Version $version
     * @param ErrorCorrectionLevel $errorCorrectionLevel
     * @param int $expectedNumEcCodewords
     * @return void
     * @throws MissingInfoException
     * @dataProvider provideDataToCalculate
     */
    public function testCalculate(
        Version $version,
        ErrorCorrectionLevel $errorCorrectionLevel,
        int $expectedNumEcCodewords
    ): void {
        $this->assertEquals(
            $expectedNumEcCodewords,
            $this->calculator
                ->withVersion($version)
                ->withErrorCorrectionLevel($errorCorrectionLevel)
                ->calculate()
        );
    }

    /**
     * @return array<array{Version, ErrorCorrectionLevel, int}>
     */
    public static function provideDataToCalculate(): array
    {
        return [
            [Version::V01, ErrorCorrectionLevel::LOW , 7],
            [Version::V01, ErrorCorrectionLevel::MEDIUM, 10],
            [Version::V01, ErrorCorrectionLevel::QUARTILE, 13],
            [Version::V01, ErrorCorrectionLevel::HIGH, 17],
            [Version::V02, ErrorCorrectionLevel::LOW , 10],
            [Version::V02, ErrorCorrectionLevel::MEDIUM, 16],
            [Version::V02, ErrorCorrectionLevel::QUARTILE, 22],
            [Version::V02, ErrorCorrectionLevel::HIGH, 28],
            [Version::V03, ErrorCorrectionLevel::LOW , 15],
            [Version::V03, ErrorCorrectionLevel::MEDIUM, 26],
            [Version::V03, ErrorCorrectionLevel::QUARTILE, 36],
            [Version::V03, ErrorCorrectionLevel::HIGH, 44],
            [Version::V04, ErrorCorrectionLevel::LOW , 20],
            [Version::V04, ErrorCorrectionLevel::MEDIUM, 36],
            [Version::V04, ErrorCorrectionLevel::QUARTILE, 52],
            [Version::V04, ErrorCorrectionLevel::HIGH, 64],
            [Version::V05, ErrorCorrectionLevel::LOW , 26],
            [Version::V05, ErrorCorrectionLevel::MEDIUM, 48],
            [Version::V05, ErrorCorrectionLevel::QUARTILE, 72],
            [Version::V05, ErrorCorrectionLevel::HIGH, 88],
            [Version::V06, ErrorCorrectionLevel::LOW , 36],
            [Version::V06, ErrorCorrectionLevel::MEDIUM, 64],
            [Version::V06, ErrorCorrectionLevel::QUARTILE, 96],
            [Version::V06, ErrorCorrectionLevel::HIGH, 112],
            [Version::V07, ErrorCorrectionLevel::LOW , 40],
            [Version::V07, ErrorCorrectionLevel::MEDIUM, 72],
            [Version::V07, ErrorCorrectionLevel::QUARTILE, 108],
            [Version::V07, ErrorCorrectionLevel::HIGH, 130],
            [Version::V08, ErrorCorrectionLevel::LOW , 48],
            [Version::V08, ErrorCorrectionLevel::MEDIUM, 88],
            [Version::V08, ErrorCorrectionLevel::QUARTILE, 132],
            [Version::V08, ErrorCorrectionLevel::HIGH, 156],
            [Version::V09, ErrorCorrectionLevel::LOW , 60],
            [Version::V09, ErrorCorrectionLevel::MEDIUM, 110],
            [Version::V09, ErrorCorrectionLevel::QUARTILE, 160],
            [Version::V09, ErrorCorrectionLevel::HIGH, 192],
            [Version::V10, ErrorCorrectionLevel::LOW , 72],
            [Version::V10, ErrorCorrectionLevel::MEDIUM, 130],
            [Version::V10, ErrorCorrectionLevel::QUARTILE, 192],
            [Version::V10, ErrorCorrectionLevel::HIGH, 224],
            [Version::V11, ErrorCorrectionLevel::LOW , 80],
            [Version::V11, ErrorCorrectionLevel::MEDIUM, 150],
            [Version::V11, ErrorCorrectionLevel::QUARTILE, 224],
            [Version::V11, ErrorCorrectionLevel::HIGH, 264],
            [Version::V12, ErrorCorrectionLevel::LOW , 96],
            [Version::V12, ErrorCorrectionLevel::MEDIUM, 176],
            [Version::V12, ErrorCorrectionLevel::QUARTILE, 260],
            [Version::V12, ErrorCorrectionLevel::HIGH, 308],
            [Version::V13, ErrorCorrectionLevel::LOW , 104],
            [Version::V13, ErrorCorrectionLevel::MEDIUM, 198],
            [Version::V13, ErrorCorrectionLevel::QUARTILE, 288],
            [Version::V13, ErrorCorrectionLevel::HIGH, 352],
            [Version::V14, ErrorCorrectionLevel::LOW , 120],
            [Version::V14, ErrorCorrectionLevel::MEDIUM, 216],
            [Version::V14, ErrorCorrectionLevel::QUARTILE, 320],
            [Version::V14, ErrorCorrectionLevel::HIGH, 384],
            [Version::V15, ErrorCorrectionLevel::LOW , 132],
            [Version::V15, ErrorCorrectionLevel::MEDIUM, 240],
            [Version::V15, ErrorCorrectionLevel::QUARTILE, 360],
            [Version::V15, ErrorCorrectionLevel::HIGH, 432],
            [Version::V16, ErrorCorrectionLevel::LOW , 144],
            [Version::V16, ErrorCorrectionLevel::MEDIUM, 280],
            [Version::V16, ErrorCorrectionLevel::QUARTILE, 408],
            [Version::V16, ErrorCorrectionLevel::HIGH, 480],
            [Version::V17, ErrorCorrectionLevel::LOW , 168],
            [Version::V17, ErrorCorrectionLevel::MEDIUM, 308],
            [Version::V17, ErrorCorrectionLevel::QUARTILE, 448],
            [Version::V17, ErrorCorrectionLevel::HIGH, 532],
            [Version::V18, ErrorCorrectionLevel::LOW , 180],
            [Version::V18, ErrorCorrectionLevel::MEDIUM, 338],
            [Version::V18, ErrorCorrectionLevel::QUARTILE, 504],
            [Version::V18, ErrorCorrectionLevel::HIGH, 588],
            [Version::V19, ErrorCorrectionLevel::LOW , 196],
            [Version::V19, ErrorCorrectionLevel::MEDIUM, 364],
            [Version::V19, ErrorCorrectionLevel::QUARTILE, 546],
            [Version::V19, ErrorCorrectionLevel::HIGH, 650],
            [Version::V20, ErrorCorrectionLevel::LOW , 224],
            [Version::V20, ErrorCorrectionLevel::MEDIUM, 416],
            [Version::V20, ErrorCorrectionLevel::QUARTILE, 600],
            [Version::V20, ErrorCorrectionLevel::HIGH, 700],
            [Version::V21, ErrorCorrectionLevel::LOW , 224],
            [Version::V21, ErrorCorrectionLevel::MEDIUM, 442],
            [Version::V21, ErrorCorrectionLevel::QUARTILE, 644],
            [Version::V21, ErrorCorrectionLevel::HIGH, 750],
            [Version::V22, ErrorCorrectionLevel::LOW , 252],
            [Version::V22, ErrorCorrectionLevel::MEDIUM, 476],
            [Version::V22, ErrorCorrectionLevel::QUARTILE, 690],
            [Version::V22, ErrorCorrectionLevel::HIGH, 816],
            [Version::V23, ErrorCorrectionLevel::LOW , 270],
            [Version::V23, ErrorCorrectionLevel::MEDIUM, 504],
            [Version::V23, ErrorCorrectionLevel::QUARTILE, 750],
            [Version::V23, ErrorCorrectionLevel::HIGH, 900],
            [Version::V24, ErrorCorrectionLevel::LOW , 300],
            [Version::V24, ErrorCorrectionLevel::MEDIUM, 560],
            [Version::V24, ErrorCorrectionLevel::QUARTILE, 810],
            [Version::V24, ErrorCorrectionLevel::HIGH, 960],
            [Version::V25, ErrorCorrectionLevel::LOW , 312],
            [Version::V25, ErrorCorrectionLevel::MEDIUM, 588],
            [Version::V25, ErrorCorrectionLevel::QUARTILE, 870],
            [Version::V25, ErrorCorrectionLevel::HIGH, 1050],
            [Version::V26, ErrorCorrectionLevel::LOW , 336],
            [Version::V26, ErrorCorrectionLevel::MEDIUM, 644],
            [Version::V26, ErrorCorrectionLevel::QUARTILE, 952],
            [Version::V26, ErrorCorrectionLevel::HIGH, 1110],
            [Version::V27, ErrorCorrectionLevel::LOW , 360],
            [Version::V27, ErrorCorrectionLevel::MEDIUM, 700],
            [Version::V27, ErrorCorrectionLevel::QUARTILE, 1020],
            [Version::V27, ErrorCorrectionLevel::HIGH, 1200],
            [Version::V28, ErrorCorrectionLevel::LOW , 390],
            [Version::V28, ErrorCorrectionLevel::MEDIUM, 728],
            [Version::V28, ErrorCorrectionLevel::QUARTILE, 1050],
            [Version::V28, ErrorCorrectionLevel::HIGH, 1260],
            [Version::V29, ErrorCorrectionLevel::LOW , 420],
            [Version::V29, ErrorCorrectionLevel::MEDIUM, 784],
            [Version::V29, ErrorCorrectionLevel::QUARTILE, 1140],
            [Version::V29, ErrorCorrectionLevel::HIGH, 1350],
            [Version::V30, ErrorCorrectionLevel::LOW , 450],
            [Version::V30, ErrorCorrectionLevel::MEDIUM, 812],
            [Version::V30, ErrorCorrectionLevel::QUARTILE, 1200],
            [Version::V30, ErrorCorrectionLevel::HIGH, 1440],
            [Version::V31, ErrorCorrectionLevel::LOW , 480],
            [Version::V31, ErrorCorrectionLevel::MEDIUM, 868],
            [Version::V31, ErrorCorrectionLevel::QUARTILE, 1290],
            [Version::V31, ErrorCorrectionLevel::HIGH, 1530],
            [Version::V32, ErrorCorrectionLevel::LOW , 510],
            [Version::V32, ErrorCorrectionLevel::MEDIUM, 924],
            [Version::V32, ErrorCorrectionLevel::QUARTILE, 1350],
            [Version::V32, ErrorCorrectionLevel::HIGH, 1620],
            [Version::V33, ErrorCorrectionLevel::LOW , 540],
            [Version::V33, ErrorCorrectionLevel::MEDIUM, 980],
            [Version::V33, ErrorCorrectionLevel::QUARTILE, 1440],
            [Version::V33, ErrorCorrectionLevel::HIGH, 1710],
            [Version::V34, ErrorCorrectionLevel::LOW , 570],
            [Version::V34, ErrorCorrectionLevel::MEDIUM, 1036],
            [Version::V34, ErrorCorrectionLevel::QUARTILE, 1530],
            [Version::V34, ErrorCorrectionLevel::HIGH, 1800],
            [Version::V35, ErrorCorrectionLevel::LOW , 570],
            [Version::V35, ErrorCorrectionLevel::MEDIUM, 1064],
            [Version::V35, ErrorCorrectionLevel::QUARTILE, 1590],
            [Version::V35, ErrorCorrectionLevel::HIGH, 1890],
            [Version::V36, ErrorCorrectionLevel::LOW , 600],
            [Version::V36, ErrorCorrectionLevel::MEDIUM, 1120],
            [Version::V36, ErrorCorrectionLevel::QUARTILE, 1680],
            [Version::V36, ErrorCorrectionLevel::HIGH, 1980],
            [Version::V37, ErrorCorrectionLevel::LOW , 630],
            [Version::V37, ErrorCorrectionLevel::MEDIUM, 1204],
            [Version::V37, ErrorCorrectionLevel::QUARTILE, 1770],
            [Version::V37, ErrorCorrectionLevel::HIGH, 2100],
            [Version::V38, ErrorCorrectionLevel::LOW , 660],
            [Version::V38, ErrorCorrectionLevel::MEDIUM, 1260],
            [Version::V38, ErrorCorrectionLevel::QUARTILE, 1860],
            [Version::V38, ErrorCorrectionLevel::HIGH, 2220],
            [Version::V39, ErrorCorrectionLevel::LOW , 720],
            [Version::V39, ErrorCorrectionLevel::MEDIUM, 1316],
            [Version::V39, ErrorCorrectionLevel::QUARTILE, 1950],
            [Version::V39, ErrorCorrectionLevel::HIGH, 2310],
            [Version::V40, ErrorCorrectionLevel::LOW , 750],
            [Version::V40, ErrorCorrectionLevel::MEDIUM, 1372],
            [Version::V40, ErrorCorrectionLevel::QUARTILE, 2040],
            [Version::V40, ErrorCorrectionLevel::HIGH, 2430],
        ];
    }
}
