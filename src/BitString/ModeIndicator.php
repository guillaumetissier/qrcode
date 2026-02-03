<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class ModeIndicator implements ModeIndicatorInterface
{
    public static function create(?Mode $mode = null): self
    {
        return new self($mode);
    }

    private function __construct(private ?Mode $mode = null)
    {
    }

    private function __clone()
    {
    }

    public function withMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function bitString(): BitStringInterface
    {
        if ($this->mode === null) {
            throw MissingParameter::missingParameter('mode', self::class);
        }

        return match ($this->mode) {
            Mode::NUMERIC => BitStringImmutable::fromString('0001'),
            Mode::ALPHANUMERIC => BitStringImmutable::fromString('0010'),
            Mode::BYTE => BitStringImmutable::fromString('0100')
        };
    }
}
