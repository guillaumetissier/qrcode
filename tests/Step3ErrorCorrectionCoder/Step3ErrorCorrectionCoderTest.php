<?php

namespace Tests\Step3ErrorCorrectionCoder;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\BitsString\DataBits;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory as GeneratorPolynomialFactory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256BinomialGenerator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256PolynomialOperations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\Step3ErrorCorrectionCoder;

class Step3ErrorCorrectionCoderTest extends LoggerTestCase
{
    private Step3ErrorCorrectionCoder $encoder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->encoder = new Step3ErrorCorrectionCoder(
            new NumECCodewordsCalculator($this->logger),
            new GeneratorPolynomialFactory(
                new Gf256BinomialGenerator(Gf256::getInstance()),
                Gf256PolynomialOperations::getInstance(),
                $this->logger
            ),
            Gf256PolynomialOperations::getInstance(),
            $this->logger
        );
    }

    public function testThrowsExceptionIfErrorCorrectionLevelNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder
            ->setVersion(Version::V14)
            ->addErrorCorrection(new DataBits([32, 91, 11, 120]));
    }

    public function testThrowsExceptionIfVersionNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)
            ->addErrorCorrection(new DataBits([32, 91, 11, 120]));
    }
}
