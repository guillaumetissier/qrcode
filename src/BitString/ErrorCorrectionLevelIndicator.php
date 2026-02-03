<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingParameter;

/**
 * ISO/IEC 18004:2000(E) -- 8.9 Format Information -- p. 53
 */
final class ErrorCorrectionLevelIndicator implements BitStringAware
{
    public static function create(?ErrorCorrectionLevel $errorCorrectionLevel = null): self
    {
        return new self($errorCorrectionLevel);
    }

    private function __construct(private ?ErrorCorrectionLevel $errorCorrectionLevel = null)
    {
    }

    private function __clone()
    {
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function bitString(): BitStringInterface
    {
        if ($this->errorCorrectionLevel === null) {
            throw MissingParameter::missingParameter('errorCorrectionLevel', self::class);
        }

        return match ($this->errorCorrectionLevel) {
            ErrorCorrectionLevel::LOW => BitStringImmutable::fromString('01'),
            ErrorCorrectionLevel::MEDIUM => BitStringImmutable::fromString('00'),
            ErrorCorrectionLevel::QUARTILE => BitStringImmutable::fromString('11'),
            ErrorCorrectionLevel::HIGH => BitStringImmutable::fromString('10'),
        };
    }
}
