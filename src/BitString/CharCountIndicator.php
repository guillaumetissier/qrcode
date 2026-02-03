<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

class CharCountIndicator implements CharCountIndicatorInterface
{
    public static function create(?Mode $mode = null, ?Version $version = null, ?int $charCount = null): self
    {
        return new self($mode, $version, $charCount);
    }

    private function __construct(
        private ?Mode $mode = null,
        private ?Version $version = null,
        private ?int $charCount = null
    ) {
    }

    private function __clone()
    {
    }

    public function withMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function withCharCount(int $charCount): self
    {
        $this->charCount = $charCount;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function bitString(): BitStringInterface
    {
        if ($this->charCount === null) {
            throw MissingParameter::missingParameter('charCount', self::class);
        }
        return BitStringImmutable::fromString(str_pad(decbin($this->charCount), $this->bitCount(), '0', STR_PAD_LEFT));
    }

    /**
     * @throws MissingParameter
     */
    private function bitCount(): int
    {
        if ($this->version === null) {
            throw MissingParameter::missingParameter('version', self::class);
        }

        if ($this->mode === null) {
            throw MissingParameter::missingParameter('mode', self::class);
        }

        if ($this->version->value <= 9) {
            return [
                Mode::NUMERIC->value => 10,
                Mode::ALPHANUMERIC->value => 9,
                Mode::BYTE->value => 8
            ][$this->mode->value];
        }

        if ($this->version->value <= 26) {
            return [
                Mode::NUMERIC->value => 12,
                Mode::ALPHANUMERIC->value => 11,
                Mode::BYTE->value => 16
            ][$this->mode->value];
        }

        return [
            Mode::NUMERIC->value => 14,
            Mode::ALPHANUMERIC->value => 13,
            Mode::BYTE->value => 16
        ][$this->mode->value];
    }
}
