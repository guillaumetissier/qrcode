<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class MaskReference implements MaskReferenceInterface
{
    public static function create(
        ?IOLoggerInterface $logger = null,
        ?Mask $mask = null
    ): self {
        return new self($logger, $mask);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null, private ?Mask $mask = null)
    {
    }

    private function __clone()
    {
    }

    public function withMask(Mask $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if ($this->mask === null) {
            throw MissingInfoException::missingInfo('mask', self::class);
        }

        $this->logger?->input("Mask = {$this->mask->value}", ['class' => self::class]);

        $maskReference = BitStringImmutable::fromString(sprintf("%03d", decbin($this->mask->value)));

        $this->logger?->output("Mask reference = $maskReference", ['class' => self::class]);

        return $maskReference;
    }
}
