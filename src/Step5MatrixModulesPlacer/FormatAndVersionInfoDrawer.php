<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;

class FormatAndVersionInfoDrawer extends AbstractPatternDrawer
{
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function setErrorCorrectionLevel(?Version $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function draw(): QrMatrix
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