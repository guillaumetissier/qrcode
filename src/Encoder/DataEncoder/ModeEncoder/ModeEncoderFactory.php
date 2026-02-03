<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder;

use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoderFactoryInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class ModeEncoderFactory implements ModeEncoderFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new ModeEncoderFactory($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    public function getModeEncoder(Mode $mode): ModeEncoderInterface
    {
        return match ($mode) {
            Mode::NUMERIC => new NumericEncoder($this->logger),
            Mode::ALPHANUMERIC => new AlphanumericEncoder($this->logger),
            Mode::BYTE => new ByteEncoder($this->logger),
        };
    }
}
