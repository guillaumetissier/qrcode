<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ModeIndicator implements ModeIndicatorInterface
{
    public static function create(?IOLoggerInterface $logger = null, ?Mode $mode = null,): self
    {
        return new self($logger, $mode);
    }

    private function __construct(
        private readonly ?IOLoggerInterface $logger = null,
        private ?Mode $mode = null,
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

    /**
     * @return BitStringInterface
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if ($this->mode === null) {
            throw MissingInfoException::missingInfo('mode', self::class);
        }

        $this->logger?->input("Mode = {$this->mode->value}", ['class' => self::class]);

        $modeIndicator = match ($this->mode) {
            Mode::NUMERIC => BitStringImmutable::fromString('0001'),
            Mode::ALPHANUMERIC => BitStringImmutable::fromString('0010'),
            Mode::BYTE => BitStringImmutable::fromString('0100')
        };

        $this->logger?->output("Mode indicator = {$modeIndicator}", ['class' => self::class]);

        return $modeIndicator;
    }
}
