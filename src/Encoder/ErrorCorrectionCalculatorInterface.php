<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;

interface ErrorCorrectionCalculatorInterface
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function withVersion(Version $version): self;

    public function calculateErrorCorrection(BitString $dataBitString): BitString;
}
