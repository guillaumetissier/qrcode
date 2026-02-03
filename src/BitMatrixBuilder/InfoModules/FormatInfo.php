<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitString\ErrorCorrectionLevelIndicator;
use Guillaumetissier\QrCode\BitString\ErrorCorrectionLevelIndicatorInterface;
use Guillaumetissier\QrCode\BitString\MaskReference;
use Guillaumetissier\QrCode\BitString\MaskReferenceInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class FormatInfo
{
    private ?Mask $mask = null;

    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            ErrorCorrectionLevelIndicator::create($logger),
            MaskReference::create($logger),
            $logger
        );
    }

    private function __construct(
        private readonly ErrorCorrectionLevelIndicatorInterface $errorCorrectionLevelIndicator,
        private readonly MaskReferenceInterface $maskReference,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    private function __clone()
    {
    }

    public function withMask(Mask $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $ecl): self
    {
        $this->errorCorrectionLevel = $ecl;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if (!$this->mask instanceof Mask) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        if (!$this->errorCorrectionLevel instanceof ErrorCorrectionLevel) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        $this->logger?->input(join(', ', [
            "Mask = {$this->mask->value}",
            "ECL = {$this->errorCorrectionLevel->value}",
        ]), ['class' => self::class]);

        $bitString = BitString::empty();
        $bitString->append($this->maskReference
            ->withMask($this->mask)
            ->bitString());
        $bitString->append($this->errorCorrectionLevelIndicator
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->bitString());

        $this->logger?->output($bitString, ['class' => self::class]);

        return BitStringImmutable::fromString($bitString->toString());
    }
}
