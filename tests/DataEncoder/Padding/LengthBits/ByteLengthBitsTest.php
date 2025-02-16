<?php

namespace Tests\DataEncoder\Padding\LengthBits;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\ByteLengthBits;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class ByteLengthBitsTest extends TestCase
{
    private ByteLengthBits $lengthBits;

    public function setUp(): void
    {
        $this->lengthBits = new ByteLengthBits();
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
            [1, Version::V01, '00000001'],
            [255, Version::V09, '11111111'],
            [1, Version::V10, '0000000000000001'],
            [65535, Version::V26, '1111111111111111'],
            [1, Version::V27, '0000000000000001'],
            [65535, Version::V40, '1111111111111111'],
        ];
    }
}
