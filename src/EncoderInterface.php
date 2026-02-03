<?php

namespace Guillaumetissier\QrCode;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;

interface EncoderInterface
{
    public function withData(string $data): self;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function getMode(): Mode;

    public function getVersion(): Version;

    public function encode(): BitString;
}
