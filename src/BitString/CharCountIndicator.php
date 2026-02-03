<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class CharCountIndicator implements CharCountIndicatorInterface
{
    public static function create(
        ?IOLoggerInterface $logger = null,
        ?Mode $mode = null,
        ?Version $version = null,
        ?int $charCount = null
    ): self {
        return new self($logger, $mode, $version, $charCount);
    }

    private function __construct(
        private readonly ?IOLoggerInterface $logger = null,
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
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if ($this->mode === null) {
            throw MissingInfoException::missingInfo('mode', self::class);
        }

        if ($this->version === null) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        if ($this->charCount === null) {
            throw MissingInfoException::missingInfo('charCount', self::class);
        }

        $this->logger?->input(
            implode(', ', [
                "Mode = {$this->mode->value}",
                "Version = {$this->version->value}",
                "Char count = {$this->charCount}",
            ]),
            ['class' => self::class]
        );

        if ($this->version->value <= 9) {
            $biCount = [
                Mode::NUMERIC->value => 10,
                Mode::ALPHANUMERIC->value => 9,
                Mode::BYTE->value => 8
            ][$this->mode->value];
        } elseif ($this->version->value <= 26) {
            $biCount = [
                Mode::NUMERIC->value => 12,
                Mode::ALPHANUMERIC->value => 11,
                Mode::BYTE->value => 16
            ][$this->mode->value];
        } else {
            $biCount = [
                Mode::NUMERIC->value => 14,
                Mode::ALPHANUMERIC->value => 13,
                Mode::BYTE->value => 16
            ][$this->mode->value];
        }

        $cci = BitStringImmutable::fromString(str_pad(decbin($this->charCount), $biCount, '0', STR_PAD_LEFT));

        $this->logger?->output("Cci = {$cci}", ['class' => self::class]);

        return $cci;
    }
}
