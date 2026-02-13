<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E) -- 8.9 Format Information -- p. 53
 */
final class ErrorCorrectionLevelIndicator implements ErrorCorrectionLevelIndicatorInterface
{
    use ErrorCorrectionLevelDependentTrait;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    /**
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        $errorCorrectionLevel = $this->errorCorrectionLevel();

        $this->logger?->input("ECL = {$errorCorrectionLevel->value}", ['class' => self::class]);

        $eclIndicator = match ($errorCorrectionLevel) {
            ErrorCorrectionLevel::LOW => BitStringImmutable::fromString('01'),
            ErrorCorrectionLevel::MEDIUM => BitStringImmutable::fromString('00'),
            ErrorCorrectionLevel::QUARTILE => BitStringImmutable::fromString('11'),
            ErrorCorrectionLevel::HIGH => BitStringImmutable::fromString('10'),
        };

        $this->logger?->output("ECL indicator = {$eclIndicator}", ['class' => self::class]);

        return $eclIndicator;
    }
}
