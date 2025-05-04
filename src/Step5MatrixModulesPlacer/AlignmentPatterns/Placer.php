<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AlignmentPatterns;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;

class Placer extends AbstractPatternPlacer
{
    private ?Version $version = null;

    public function __construct(private readonly Positions $positions)
    {
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function place(): QrMatrix
    {
        if ($this->version->value < 2) {
            return $this->matrix;
        }

        $alignmentPositions = $this->positions->getPositions();

        foreach ($alignmentPositions as [$centerX, $centerY]) {
            for ($x = -2; $x <= 2; $x++) {
                for ($y = -2; $y <= 2; $y++) {
                    $this->matrix->set(
                        $centerX + $x,
                        $centerY + $y,
                        (abs($x) == 2 || abs($y) == 2 || ($x == 0 && $y == 0))
                    );
                }
            }
        }

        return $this->matrix;
    }
}
