<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\ModeDependentTrait;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ModeIndicator implements ModeIndicatorInterface
{
    use ModeDependentTrait;

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
     * @return BitStringInterface
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        $mode = $this->mode();

        $this->logger?->input("Mode = {$mode->value}", ['class' => self::class]);

        $modeIndicator = match ($mode) {
            Mode::NUMERIC => BitStringImmutable::fromString('0001'),
            Mode::ALPHANUMERIC => BitStringImmutable::fromString('0010'),
            Mode::BYTE => BitStringImmutable::fromString('0100')
        };

        $this->logger?->output("Mode indicator = {$modeIndicator}", ['class' => self::class]);

        return $modeIndicator;
    }
}
