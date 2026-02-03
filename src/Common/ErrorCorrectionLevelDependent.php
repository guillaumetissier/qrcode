<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\BitString\BitStringAware;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface ErrorCorrectionLevelDependent extends BitStringAware
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;
}
