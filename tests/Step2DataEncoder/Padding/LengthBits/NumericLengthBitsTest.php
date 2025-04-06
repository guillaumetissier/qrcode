<?php

namespace Tests\Step2DataEncoder\Padding\LengthBits;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits\NumericLengthBits;

class NumericLengthBitsTest extends LoggerTestCase
{
    private NumericLengthBits $lengthBits;

    public function setUp(): void
    {
        parent::setUp();

        $this->lengthBits = new NumericLengthBits($this->logger);
    }

    /**
     * @dataProvider provideDataToGetLengthBits
     */
    public function testGetLengthBits(int $dataLength, Version $version, string $expectedLengthBits): void
    {
        $this->assertEquals(
            $expectedLengthBits,
            $this->lengthBits->setDataLength($dataLength)->setVersion($version)->getLengthBits()
        );
    }

    public static function provideDataToGetLengthBits(): array
    {
        return [
            [1, Version::V01, '0000000001'],
            [512, Version::V09, '1000000000'],
            [1, Version::V10, '000000000001'],
            [4095, Version::V26, '111111111111'],
            [1, Version::V27, '00000000000001'],
            [16383, Version::V40, '11111111111111'],
        ];
    }
}
