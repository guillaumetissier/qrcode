<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\BitString\BitStringAware;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface ErrorCorrectionLevelDependent extends BitStringAware
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;
}
