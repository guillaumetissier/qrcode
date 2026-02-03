<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) -- 8.9 Format Information -- p. 53
 */
final class ErrorCorrectionLevelIndicator implements ErrorCorrectionLevelIndicatorInterface
{
    public static function create(
        ?IOLoggerInterface $logger = null,
        ?ErrorCorrectionLevel $errorCorrectionLevel = null
    ): self {
        return new self($logger, $errorCorrectionLevel);
    }

    private function __construct(
        private readonly ?IOLoggerInterface $logger = null,
        private ?ErrorCorrectionLevel $errorCorrectionLevel = null
    ) {
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
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if ($this->errorCorrectionLevel === null) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        $this->logger?->input("ECL = {$this->errorCorrectionLevel->value}", ['class' => self::class]);

        $eclIndicator = match ($this->errorCorrectionLevel) {
            ErrorCorrectionLevel::LOW => BitStringImmutable::fromString('01'),
            ErrorCorrectionLevel::MEDIUM => BitStringImmutable::fromString('00'),
            ErrorCorrectionLevel::QUARTILE => BitStringImmutable::fromString('11'),
            ErrorCorrectionLevel::HIGH => BitStringImmutable::fromString('10'),
        };

        $this->logger?->output("ECL indicator = {$eclIndicator}", ['class' => self::class]);

        return $eclIndicator;
    }
}
