<?php

namespace Tests\DataEncoder\Padding\LengthBits;

use PHPUnit\Framework\TestCase;
use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\AlphanumericLengthBits;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class AlphanumericLengthBitsTest extends LoggerTestCase
{
    private AlphanumericLengthBits $lengthBits;

    public function setUp(): void
    {
        parent::setUp();

        $this->lengthBits = new AlphanumericLengthBits($this->logger);
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
            [1, Version::V01, '000000001'],
            [45, Version::V01, '000101101'],
            [511, Version::V01, '111111111'],
            [1, Version::V10, '00000000001'],
            [2047, Version::V26, '11111111111'],
            [1, Version::V27, '0000000000001'],
            [8191, Version::V40, '1111111111111'],
        ];
    }
}
