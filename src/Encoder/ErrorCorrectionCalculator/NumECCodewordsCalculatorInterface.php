<?php

namespace Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Version;

interface NumECCodewordsCalculatorInterface
{
    public function withErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self;

    public function withVersion(?Version $version): self;

    public function calculate(): int;
}
