<?php

namespace Tests\Step3ErrorCorrectionCoder;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\Exception\VariableNotSetException;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory as GeneratorPolynomialFactory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256Operations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256BinomialGenerator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256PolynomialOperations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\RemainderCalculator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\Step3ErrorCorrectionCoder;

class Step3ErrorCorrectionCoderTest extends LoggerTestCase
{
    private Step3ErrorCorrectionCoder $encoder;

    protected function setUp(): void
    {
        parent::setUp();

        $gf256 = Gf256::getGf256();
        $gf256Operations = new Gf256Operations($gf256);
        $this->encoder = new Step3ErrorCorrectionCoder(
            new NumECCodewordsCalculator($this->logger),
            new GeneratorPolynomialFactory(
                new Gf256BinomialGenerator($gf256),
                new Gf256PolynomialOperations($gf256Operations),
                $this->logger
            ),
            new RemainderCalculator($gf256Operations, $this->logger),
            $this->logger
        );
    }

    public function testThrowsExceptionIfErrorCorrectionLevelNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder->setVersion(Version::V14)->addErrorCorrection([32, 91, 11, 120]);
    }

    public function testThrowsExceptionIfVersionNotSet(): void
    {
        $this->expectException(VariableNotSetException::class);
        $this->encoder->setErrorCorrectionLevel(ErrorCorrectionLevel::MEDIUM)->addErrorCorrection([32, 91, 11, 120]);
    }
}
