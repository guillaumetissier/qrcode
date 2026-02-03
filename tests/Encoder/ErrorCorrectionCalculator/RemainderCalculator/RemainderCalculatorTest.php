<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Tests\Encoder\ErrorCorrectionCalculator\RemainderCalculator;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\GaloisFields\GaloisField;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialConverter;
use Guillaumetissier\GaloisFields\Polynomial\PolynomialImmutable;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\RemainderCalculator\RemainderCalculator;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

class RemainderCalculatorTest extends TestCase
{
    private GaloisField $gf256;
    private PolynomialConverter $converter;

    protected function setUp(): void
    {
        $this->gf256     = new GaloisField(256);
        $this->converter = new PolynomialConverter($this->gf256);
    }

//    public function testCreateWithoutLogger(): void
//    {
//        $this->assertInstanceOf(RemainderCalculator::class, RemainderCalculator::create());
//    }
//
//    public function testWithGeneratorPolynomialReturnsSelf(): void
//    {
//        $calculator = RemainderCalculator::create();
//        $generator  = $this->createGeneratorPolynomial7();
//
//        $this->assertSame($calculator, $calculator->withGeneratorPolynomial($generator));
//    }

    public function testCalculateWithQrGeneratorDegree7(): void
    {
        // GP7 = α^0x^7 + α^87x^6 + α^229x^5 + α^146x^4 + α^149x^3 + α^238x^2 + α^102x + α^21
        // Data: 16 codewords (128 bits) → remainder: 7 codewords (56 bits)
        $generator = $this->createGeneratorPolynomial7();
        $data = BitString::fromString(
            '00100000' . '01000001' . '11001101' . '01000101' .  // 32, 65, 205, 69
            '00101001' . '11011100' . '00101110' . '10000000' .  // 41, 220, 46, 128
            '11101100' . '00010001' . '11101100' . '00010001' .  // 236, 17, 236, 17
            '11101100' . '00010001' . '11101100' . '00010001'    // 236, 17, 236, 17
        );

        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder = $calculator->calculate($data);

        // Remainder should be 7 bytes (56 bits)
        $this->assertInstanceOf(BitStringImmutable::class, $remainder);
        $this->assertSame(56, $remainder->length());
    }

    public function testCalculateRemainderDegreeLessThanGenerator(): void
    {
        $generator = $this->createGeneratorPolynomial7();

        $data = BitString::fromString(
            str_repeat('00100000', 16) // 16 identical bytes
        );

        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder = $calculator->calculate($data);
        $remainderPoly = $this->converter->fromBitString($remainder);

        // Remainder degree must be < generator degree (7)
        $this->assertLessThan($generator->degree(), $remainderPoly->degree());
    }

    public function testCalculateWithQrGeneratorDegree10(): void
    {
        // GP10 = α^0x^10 + α^251x^9 + α^67x^8 + ... + α^45
        $generator = $this->createGeneratorPolynomial10();
        // Data: 26 codewords (208 bits) → remainder: 10 codewords (80 bits)
        $data = BitString::fromString(str_repeat('10110101', 26));
        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder = $calculator->calculate($data);

        $this->assertSame(80, $remainder->length());
    }

    public function testCalculateSameInputProducesSameOutput(): void
    {
        $generator = $this->createGeneratorPolynomial7();
        $data      = BitString::fromString(str_repeat('11110000', 16));
        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder1 = $calculator->calculate($data);
        $remainder2 = $calculator->calculate($data);

        $this->assertSame($remainder1->toString(), $remainder2->toString());
    }

    public function testCalculateDifferentInputProducesDifferentOutput(): void
    {
        $generator = $this->createGeneratorPolynomial7();
        $data1 = BitString::fromString(str_repeat('11110000', 16));
        $data2 = BitString::fromString(str_repeat('00001111', 16));
        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder1 = $calculator->calculate($data1);
        $remainder2 = $calculator->calculate($data2);

        $this->assertNotSame($remainder1->toString(), $remainder2->toString());
    }

    public function testCalculateWithoutLoggerDoesNotCrash(): void
    {
        $generator = $this->createGeneratorPolynomial7();
        $data = BitString::fromString(str_repeat('10110101', 16));
        $calculator = RemainderCalculator::create()->withGeneratorPolynomial($generator);
        $remainder = $calculator->calculate($data);

        $this->assertInstanceOf(BitStringImmutable::class, $remainder);
    }

    public function testCalculateThrowsIfGeneratorNotSet(): void
    {
        $calculator = RemainderCalculator::create();
        $data = BitString::fromString('10110101');

        $this->expectException(MissingInfoException::class); // Null argument on mod()
        $calculator->calculate($data);
    }

    /**
     * GP7: α^0x^7 + α^87x^6 + α^229x^5 + α^146x^4 + α^149x^3 + α^238x^2 + α^102x + α^21
     */
    private function createGeneratorPolynomial7(): PolynomialImmutable
    {
        return PolynomialImmutable::fromCoefficients(
            $this->gf256,
            [
                $this->gf256->exp(0),    // α^0 = 1
                $this->gf256->exp(87),   // α^87
                $this->gf256->exp(229),  // α^229
                $this->gf256->exp(146),  // α^146
                $this->gf256->exp(149),  // α^149
                $this->gf256->exp(238),  // α^238
                $this->gf256->exp(102),  // α^102
                $this->gf256->exp(21),   // α^21
            ]
        );
    }

    /**
     * GP10: α^0x^10 + α^251x^9 + α^67x^8 + α^46x^7 + α^61x^6 + α^118x^5
     *       + α^70x^4 + α^64x^3 + α^94x^2 + α^32x + α^45
     */
    private function createGeneratorPolynomial10(): PolynomialImmutable
    {
        return PolynomialImmutable::fromCoefficients(
            $this->gf256,
            [
                $this->gf256->exp(0),    // α^0
                $this->gf256->exp(251),  // α^251
                $this->gf256->exp(67),   // α^67
                $this->gf256->exp(46),   // α^46
                $this->gf256->exp(61),   // α^61
                $this->gf256->exp(118),  // α^118
                $this->gf256->exp(70),   // α^70
                $this->gf256->exp(64),   // α^64
                $this->gf256->exp(94),   // α^94
                $this->gf256->exp(32),   // α^32
                $this->gf256->exp(45),   // α^45
            ]
        );
    }
}
