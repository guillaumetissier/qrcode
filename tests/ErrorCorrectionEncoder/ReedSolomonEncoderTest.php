<?php

namespace Tests\ErrorCorrectionEncoder;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\GalloisField;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ReedSolomonEncoder;
use ThePhpGuild\QrCode\Exception\OutOfRangeException;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;

class ReedSolomonEncoderTest extends TestCase
{
    private ReedSolomonEncoder $encoder;

    protected function setUp(): void
    {
        $this->encoder = new ReedSolomonEncoder(new GalloisField(), new NumECCodewordsCalculator());
    }

    /**
     * @throws OutOfRangeException
     * @throws VariableNotSetException
     * @dataProvider provideDataToAddErrorCorrection
     */
    public function testAddErrorCorrection(
        ErrorCorrectionLevel $errorCorrectionLevel,
        Version $version,
        array $data,
        array $expectedData
    ): void
    {
        $this->assertEquals(
            $expectedData,
            $this->encoder
                ->setErrorCorrectionLevel($errorCorrectionLevel)
                ->setVersion($version)
                ->addErrorCorrection($data)
        );
    }

    public static function provideDataToAddErrorCorrection(): array
    {
        return [
            [
                ErrorCorrectionLevel::MEDIUM,
                Version::V05,
                [32, 91, 11, 120, 209, 114, 220],
                [
                    32, 91, 11, 120, 209, 114, 220, // data
                    15, 67, 62, 13, 2, 18, // error codes
                    242, 82, 88, 73, 174, 86,
                    60, 161, 168, 36, 173, 188,
                    218, 197, 207, 98, 197, 115,
                    43, 14, 139, 190, 102, 43,
                    33, 77, 191, 96, 99, 170,
                    10, 147, 85, 101, 212, 240,
                    71, 136, 52, 178, 15, 185,
                ],
            ],
        ];
    }

    /**
     * @throws OutOfRangeException
     */
    public function testThrowsExceptionIfErrorCorrectionLevelNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder
            ->setVersion(Version::V14)
            ->addErrorCorrection([32, 91, 11, 120]);
    }

    /**
     * @return void
     * @throws OutOfRangeException
     * @throws VariableNotSetException
     */
    public function testThrowsExceptionIfVersionNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->addErrorCorrection([32, 91, 11, 120]);
    }
}
