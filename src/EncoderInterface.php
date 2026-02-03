<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

interface EncoderInterface
{
    public function withData(string $data): self;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function mode(): Mode;

    public function version(): Version;

    public function encode(): BitStringInterface;
}
