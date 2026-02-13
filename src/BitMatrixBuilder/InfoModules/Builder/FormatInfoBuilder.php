<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\BitString\Converter\BitsConverter;
use Guillaumetissier\GaloisFields\GaloisField;
use Guillaumetissier\GaloisFields\Polynomial\Polynomial;
use Guillaumetissier\QrCode\BitMatrixBuilder\FormatInfoBuilderInterface;
use Guillaumetissier\QrCode\BitString\ErrorCorrectionLevelIndicator;
use Guillaumetissier\QrCode\BitString\ErrorCorrectionLevelIndicatorInterface;
use Guillaumetissier\QrCode\BitString\MaskReference;
use Guillaumetissier\QrCode\BitString\MaskReferenceInterface;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

/**
 * Generates QR Code Format Information using BCH (15,5) error correction.
 *
 * @see ISO/IEC 18004:2000(E), Annex C, p.76
 */
final class FormatInfoBuilder implements FormatInfoBuilderInterface
{
    use ErrorCorrectionLevelDependentTrait;

    /**
     * g(x) = x^10 + x^8 + x^5 + x^4 + x^2 + x + 1
     */
    private const GENERATOR_POLYNOMIAL = [1, 0, 1, 0, 0, 1, 1, 0, 1, 1, 1];

    /**
     * Fixed XOR mask to prevent all-zero string = 101010000010010 in binary
     */
    private const XOR_MASK = '101010000010010';

    private ?Mask $mask = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            ErrorCorrectionLevelIndicator::create($logger),
            MaskReference::create($logger),
            new GaloisField(2),
            new BitsConverter(),
            $logger
        );
    }

    private function __construct(
        private readonly ErrorCorrectionLevelIndicatorInterface $errorCorrectionLevelIndicator,
        private readonly MaskReferenceInterface $maskReference,
        private readonly GaloisField $gf,
        private readonly BitsConverter $converter,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    public function withMask(Mask $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function build(): BitStringInterface
    {
        if (!$this->mask instanceof Mask) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        $errorCorrectionLevel = $this->errorCorrectionLevel();

        $this->logger?->input([
            'Mask' => $this->mask,
            'ECL' => $errorCorrectionLevel,
        ], ['class' => self::class]);

        $formatInformation = BitString::empty();

        $formatInformation->append($this->errorCorrectionLevelIndicator
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->bitString());

        $formatInformation->append($this->maskReference
            ->withMask($this->mask)
            ->bitString());

        // create corresponding polynomial in GF(2) from bitString
        $bits = $this->converter->fromBitString($formatInformation);
        $polynomial = Polynomial::fromCoefficients($this->gf, $bits);

        // multiply the polynomial by x^10
        $polynomial->mul(Polynomial::fromCoefficients($this->gf, [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]));

        // calculate the remainder from the division of the polynomial by the generator polynomial
        $generatorPolynomial = Polynomial::fromCoefficients($this->gf, self::GENERATOR_POLYNOMIAL);
        $remainder = $polynomial->mod($generatorPolynomial);

        // deduce the error correction from the coefficients of the remainder
        $errorCorrection = $this->converter->toBitString($remainder->coefficients());
        $errorCorrection->pad(10);

        // append the error correction to the initial data
        $formatInformation->append($errorCorrection);

        // apply the mask to the bit string
        $formatInformation->xor(self::XOR_MASK);

        $this->logger?->output("Format information = $formatInformation", ['class' => self::class]);

        return $formatInformation;
    }
}
