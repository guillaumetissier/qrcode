<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use Guillaumetissier\QrCode\BitString\MaskReference;
use Guillaumetissier\QrCode\Enums\Mask;
use PHPUnit\Framework\TestCase;

class MaskReferenceTest extends TestCase
{
    /**
     * @dataProvider provideDataToToString
     */
    public function testToString(Mask $mask, string $expectedModeIndicator): void
    {
        $this->assertEquals($expectedModeIndicator, MaskReference::create(null, $mask)->bitString()->toString());
    }

    /**
     * @return array<array{Mask, string}>
     */
    public static function provideDataToToString(): array
    {
        return [
            [Mask::MASK0, '000'],
            [Mask::MASK1, '001'],
            [Mask::MASK2, '010'],
            [Mask::MASK3, '011'],
            [Mask::MASK4, '100'],
            [Mask::MASK5, '101'],
            [Mask::MASK6, '110'],
            [Mask::MASK7, '111'],
        ];
    }
}
