<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Builder;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder\FormatInfoBuilder;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class FormatInfoBuilderTest extends TestCase
{
    private FormatInfoBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = FormatInfoBuilder::create();
    }

    /**
     * @param ErrorCorrectionLevel $errorCorrectionLevel
     * @param Mask $mask
     * @param string $expected
     * @return void
     * @throws MissingInfoException
     *
     * @dataProvider dataBuild
     */
    public function testBuild(ErrorCorrectionLevel $errorCorrectionLevel, Mask $mask, string $expected): void
    {
        $this->assertEquals(
            $expected,
            $this->builder
                ->withErrorCorrectionLevel($errorCorrectionLevel)
                ->withMask($mask)
                ->build()
        );
    }

    /**
     * @return array<string, array{ErrorCorrectionLevel, Mask, string}>
     */
    public static function dataBuild(): array
    {
        return [
            // ECL L (01) + Mask 0-7
            'ECL_L mask_0' => [ErrorCorrectionLevel::LOW, Mask::MASK0, '111011111000100'],
            'ECL_L mask_1' => [ErrorCorrectionLevel::LOW, Mask::MASK1, '111001011110011'],
            'ECL_L mask_2' => [ErrorCorrectionLevel::LOW, Mask::MASK2, '111110110101010'],
            'ECL_L mask_3' => [ErrorCorrectionLevel::LOW, Mask::MASK3, '111100010011101'],
            'ECL_L mask_4' => [ErrorCorrectionLevel::LOW, Mask::MASK4, '110011000101111'],
            'ECL_L mask_5' => [ErrorCorrectionLevel::LOW, Mask::MASK5, '110001100011000'],
            'ECL_L mask_6' => [ErrorCorrectionLevel::LOW, Mask::MASK6, '110110001000001'],
            'ECL_L mask_7' => [ErrorCorrectionLevel::LOW, Mask::MASK7, '110100101110110'],

            // ECL M (00) + Mask 0-7
            'ECL_M mask_0' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK0, '101010000010010'],
            'ECL_M mask_1' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK1, '101000100100101'],
            'ECL_M mask_2' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK2, '101111001111100'],
            'ECL_M mask_3' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK3, '101101101001011'],
            'ECL_M mask_4' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK4, '100010111111001'],
            'ECL_M mask_5' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK5, '100000011001110'],
            'ECL_M mask_6' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK6, '100111110010111'],
            'ECL_M mask_7' => [ErrorCorrectionLevel::MEDIUM, Mask::MASK7, '100101010100000'],

            // ECL Q (11) + Mask 0-7
            'ECL_Q mask_0' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK0, '011010101011111'],
            'ECL_Q mask_1' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK1, '011000001101000'],
            'ECL_Q mask_2' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK2, '011111100110001'],
            'ECL_Q mask_3' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK3, '011101000000110'],
            'ECL_Q mask_4' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK4, '010010010110100'],
            'ECL_Q mask_5' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK5, '010000110000011'],
            'ECL_Q mask_6' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK6, '010111011011010'],
            'ECL_Q mask_7' => [ErrorCorrectionLevel::QUARTILE, Mask::MASK7, '010101111101101'],

            // ECL H (10) + Mask 0-7
            'ECL_H mask_0' => [ErrorCorrectionLevel::HIGH, Mask::MASK0, '001011010001001'],
            'ECL_H mask_1' => [ErrorCorrectionLevel::HIGH, Mask::MASK1, '001001110111110'],
            'ECL_H mask_2' => [ErrorCorrectionLevel::HIGH, Mask::MASK2, '001110011100111'],
            'ECL_H mask_3' => [ErrorCorrectionLevel::HIGH, Mask::MASK3, '001100111010000'],
            'ECL_H mask_4' => [ErrorCorrectionLevel::HIGH, Mask::MASK4, '000011101100010'],
            'ECL_H mask_5' => [ErrorCorrectionLevel::HIGH, Mask::MASK5, '000001001010101'],
            'ECL_H mask_6' => [ErrorCorrectionLevel::HIGH, Mask::MASK6, '000110100001100'],
            'ECL_H mask_7' => [ErrorCorrectionLevel::HIGH, Mask::MASK7, '000100000111011'],
        ];
    }
}
