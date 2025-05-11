<?php

namespace ThePhpGuild\QrCode\Step7FormatAndVersionPlacer;

use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;

class FormatAndVersionInfoPlacer extends AbstractPatternPlacer
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function setErrorCorrectionLevel(?Version $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function place(): Matrix
    {
        for ($i = 0; $i < 15; $i++) {
            if ($i < 6) {
                $this->matrix->set($i, 8, $this->getFormatBit($i));
                $this->matrix->set(8, $i, $this->getFormatBit($i));
            } elseif ($i > 8) {
                $this->matrix->set($i - 1, 8, $this->getFormatBit($i));
                $this->matrix->set(8, $i - 1, $this->getFormatBit($i));
            }
        }

        return $this->matrix;
    }

    private function getFormatBit($i): bool
    {
        // Placeholder: this would be computed based on error correction level and mask
        return ($i % 2 == 0);
    }
}