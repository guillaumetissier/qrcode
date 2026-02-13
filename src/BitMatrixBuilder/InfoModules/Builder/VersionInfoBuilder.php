<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\BitString\Converter\BitsConverter;
use Guillaumetissier\GaloisFields\GaloisField;
use Guillaumetissier\GaloisFields\Polynomial\Polynomial;
use Guillaumetissier\QrCode\BitMatrixBuilder\VersionInfoBuilderInterface;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class VersionInfoBuilder implements VersionInfoBuilderInterface
{
    use VersionDependentTrait;

    /**
     * g(x) = x^12 + x^11 + x^10 + x^9 + x^8 + x^5 + x^2 + 1
     */
    private const GENERATOR_POLYNOMIAL = [1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 0, 1];

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(new GaloisField(2), new BitsConverter(), $logger);
    }

    private function __construct(
        private readonly GaloisField $gf,
        private readonly BitsConverter $bitsConverter,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    private function __clone()
    {
    }

    /**
     * @return BitStringInterface|null
     * @throws MissingInfoException
     */
    public function build(): ?BitStringInterface
    {
        $version = $this->version();

        if ($version->value < Version::V07->value) {
            return null;
        }

        $this->logger?->input(['version' => $version], ['class' => self::class]);

        $versionInfo = BitString::fromString(decbin($version->value))->pad(6);

        $polynomial = new Polynomial($this->gf, $this->bitsConverter->fromBitString($versionInfo));
        $polynomial->mul(new Polynomial($this->gf, [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]));

        $generatorPolynomial = new Polynomial($this->gf, self::GENERATOR_POLYNOMIAL);
        $remainder = $polynomial->mod($generatorPolynomial);

        // deduce the error correction from the coefficients of the remainder
        $errorCorrection = $this->bitsConverter->toBitString($remainder->coefficients())->pad(12);

        $versionInfo->append($errorCorrection);

        $this->logger?->output("Version info = $versionInfo", ['class' => self::class]);

        return $versionInfo;
    }
}
