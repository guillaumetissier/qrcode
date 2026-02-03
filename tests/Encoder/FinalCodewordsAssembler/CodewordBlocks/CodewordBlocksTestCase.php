<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\BaseCodewordBlocks;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

class CodewordBlocksTestCase extends LoggerTestCase
{
    protected BaseCodewordBlocks $codewordBlocks;

    protected static int $TotalNumberOfCodewords = 0;

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfDataCodewords = [];

    /**
     * @var array<string, int>
     */
    protected static array $TotalNumberOfErrorCorrectionCodewords = [];

    /**
     * @var array<ErrorCorrectionLevel>
     */
    protected static array $ErrorCorrectionLevels = [
        ErrorCorrectionLevel::LOW,
        ErrorCorrectionLevel::MEDIUM,
        ErrorCorrectionLevel::QUARTILE,
        ErrorCorrectionLevel::HIGH,
    ];

    /**
     * @dataProvider dataTotalNumCodewords
     */
    public function testTotalNumCodewords(ErrorCorrectionLevel $ecLevel, int $expectedNumCodewords): void
    {
        $total = 0;
        foreach ($this->codewordBlocks->withErrorCorrectionLevel($ecLevel)->getBlocks() as $numBlock) {
            [$num, $block] = $numBlock;
            $total += $num * $block->totalNumCodewords();
        }

        $this->assertEquals($expectedNumCodewords, $total);
    }

    public static function dataTotalNumCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfCodewords];
        }
    }

    /**
     * @dataProvider dataNumDataCodewords
     */
    public function testNumDataCodewords(ErrorCorrectionLevel $ecLevel, int $expectedNumCodewords): void
    {
        $numDataCodewords = 0;
        foreach ($this->codewordBlocks->withErrorCorrectionLevel($ecLevel)->getBlocks() as $numBlock) {
            [$num, $block] = $numBlock;
            $numDataCodewords += $num * $block->numDataCodewords();
        }

        $this->assertEquals($expectedNumCodewords, $numDataCodewords);
    }

    public static function dataNumDataCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfDataCodewords[$errorCorrectionLevel->value]];
        }
    }

    /**
     * @dataProvider dataNumEcCodewords
     */
    public function testNumEcCodewords(ErrorCorrectionLevel $ecLevel, int $expectedNumCodewords): void
    {
        $numEcCodewords = 0;
        foreach ($this->codewordBlocks->withErrorCorrectionLevel($ecLevel)->getBlocks() as $numBlock) {
            [$num, $block] = $numBlock;
            $numEcCodewords += $num * $block->numErrorCorrectionCodewords();
        }

        $this->assertEquals($expectedNumCodewords, $numEcCodewords);
    }

    public static function dataNumEcCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfErrorCorrectionCodewords[$errorCorrectionLevel->value]];
        }
    }
}
