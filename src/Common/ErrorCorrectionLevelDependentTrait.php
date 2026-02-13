<?php

namespace Guillaumetissier\QrCode\Common;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

trait ErrorCorrectionLevelDependentTrait
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    protected function errorCorrectionLevel(): ErrorCorrectionLevel
    {
        if ($this->errorCorrectionLevel === null) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        return $this->errorCorrectionLevel;
    }
}
