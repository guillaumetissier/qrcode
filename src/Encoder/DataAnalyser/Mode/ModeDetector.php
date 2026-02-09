<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataAnalyser\Mode;

use Guillaumetissier\QrCode\Encoder\ModeDetectorInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ModeDetector implements ModeDetectorInterface
{
    private ?string $data = null;

    public static function create(IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function detect(): Mode
    {
        if (null === $this->data) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        $this->logger?->input("Data = '{$this->data}'", ['class' => self::class]);

        if (ctype_digit($this->data)) {
            $this->logger?->output("Mode = NUMERIC", ['class' => self::class]);
            return Mode::NUMERIC;
        }

        if (preg_match('#^[0-9A-Z $%*+\-./:]*$#', $this->data)) {
            $this->logger?->output("Mode = ALPHANUMERIC", ['class' => self::class]);
            return Mode::ALPHANUMERIC;
        }

        $this->logger?->output("Mode = BYTE", ['class' => self::class]);
        return Mode::BYTE;
    }
}
