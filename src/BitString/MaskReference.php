<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mask;
use Guillaumetissier\QrCode\Exception\MissingParameter;

class MaskReference implements MaskReferenceInterface
{
    public static function create(?Mask $mask = null): self
    {
        return new self($mask);
    }

    private function __construct(private ?Mask $mask = null)
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
     * @throws MissingParameter
     */
    public function bitString(): BitStringInterface
    {
        if ($this->mask === null) {
            throw MissingParameter::missingParameter('mask', self::class);
        }

        return BitStringImmutable::fromString(sprintf("%03d", decbin($this->mask->value)));
    }
}
