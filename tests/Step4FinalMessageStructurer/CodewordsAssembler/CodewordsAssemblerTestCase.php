<?php

namespace Tests\Step4FinalMessageStructurer\CodewordsAssembler;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler\BaseCodewordsAssembler;

class CodewordsAssemblerTestCase extends LoggerTestCase
{
    protected BaseCodewordsAssembler $codewordsAssembler;

    protected static int $TotalNumberOfCodewords = 0;

    protected static array $TotalNumberOfDataCodewords = [];

    protected static array $TotalNumberOfErrorCorrectionCodewords = [];

    protected static array $AssembledCodewords = [];

    protected static array $ErrorCorrectionLevels = [
        ErrorCorrectionLevel::LOW,
        ErrorCorrectionLevel::MEDIUM,
        ErrorCorrectionLevel::QUARTILE,
        ErrorCorrectionLevel::HIGH,
    ];

    /**
     * @dataProvider provideDataToTestGetTotalNumberOfCodewords
     */
    public function testGetTotalNumberOfCodewords(
        ErrorCorrectionLevel $errorCorrectionLevel,
        int $expectedNumberOfCodewords
    ): void
    {
        $this->assertEquals(
            $expectedNumberOfCodewords,
            $this->codewordsAssembler
                ->setErrorCorrectionLevel($errorCorrectionLevel)
                ->getTotalNumberOfCodewords()
        );
    }

    public static function provideDataToTestGetTotalNumberOfCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfCodewords];
        }
    }

    /**
     * @dataProvider provideDataToTestGetNumberOfDataCodewords
     */
    public function testGetNumberOfDataCodewords(
        ErrorCorrectionLevel $errorCorrectionLevel,
        int $expectedNumberOfCodewords
    ): void
    {
        $this->assertEquals(
            $expectedNumberOfCodewords,
            $this->codewordsAssembler
                ->setErrorCorrectionLevel($errorCorrectionLevel)
                ->getNumberOfDataCodewords()
        );
    }

    public static function provideDataToTestGetNumberOfDataCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfDataCodewords[$errorCorrectionLevel->value]];
        }
    }

    /**
     * @dataProvider provideDataToTestGetNumberOfEcCodewords
     */
    public function testGetNumberOfEcCodewords(
        ErrorCorrectionLevel $errorCorrectionLevel,
        int $expectedNumberOfCodewords
    ): void
    {
        $this->assertEquals(
            $expectedNumberOfCodewords,
            $this->codewordsAssembler
                ->setErrorCorrectionLevel($errorCorrectionLevel)
                ->getNumberOfErrorCorrectionCodewords()
        );
    }

    public static function provideDataToTestGetNumberOfEcCodewords(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [$errorCorrectionLevel, static::$TotalNumberOfErrorCorrectionCodewords[$errorCorrectionLevel->value]];
        }
    }

    /**
     * @dataProvider provideDataToTestAssemble
     */
    public function testAssemble(
        ErrorCorrectionLevel $level,
        string $dataCodewords,
        string $errorCodewords,
        string $expectedResult
    ): void
    {
        $this->assertEquals(
            $expectedResult,
            $this->codewordsAssembler
                ->setErrorCorrectionLevel($level)
                ->assemble($dataCodewords, $errorCodewords)
        );
    }

    public static function provideDataToTestAssemble(): \Generator
    {
        foreach (static::$ErrorCorrectionLevels as $errorCorrectionLevel) {
            yield [
                $errorCorrectionLevel,
                self::buildDataString(static::$TotalNumberOfDataCodewords[$errorCorrectionLevel->value]),
                self::buildErrorString(static::$TotalNumberOfErrorCorrectionCodewords[$errorCorrectionLevel->value]),
                static::$AssembledCodewords[$errorCorrectionLevel->value]
            ];
        }
    }

    protected static function buildDataString(int $length): string
    {
        $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $dataString = '';
        while (strlen($dataString) < $length) {
            $dataString .= $string;
        }

        return substr($dataString, 0, $length);
    }

    protected static function buildErrorString(int $length): string
    {
        $string = '0123456789';
        $errorString = '';
        while (strlen($errorString) < $length) {
            $errorString .= $string;
        }

        return substr($errorString, 0, $length);
    }
}
