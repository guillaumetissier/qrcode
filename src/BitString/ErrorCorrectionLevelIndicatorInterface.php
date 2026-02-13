<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;

interface ErrorCorrectionLevelIndicatorInterface extends BitStringAware
{
    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self;
}
