<?php

namespace Tests\Step3ErrorCorrectionCoder\GeneratorPolynomial;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\GalloisField;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\GeneratorPolynomialCreator;

class GeneratorPolynomialCreatorTest extends LoggerTestCase
{
    private GeneratorPolynomialCreator $generatorPolynomialCreator;

    public function setUp(): void
    {
        parent::setUp();

        $this->generatorPolynomialCreator = new GeneratorPolynomialCreator(new GalloisField(), $this->logger);
    }

    /**
     * @dataProvider provideDataToTestCreate
     */
    public function testCreate(int $numECCodewords, array $expectedPolynomial): void
    {
        $this->assertEquals($expectedPolynomial, $this->generatorPolynomialCreator->create($numECCodewords));
    }

    public static function provideDataToTestCreate(): \Generator
    {
        yield [
            7,
            [1, 127, 122, 154, 164, 11, 68, 117],
        ];
    }
}
