<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FinderPatterns;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AbstractPatternPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\QrMatrix;

class Placer extends AbstractPatternPlacer
{
    private ?Version $version = null;

    public function __construct(private readonly Positions $positions)
    {
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function place(): QrMatrix
    {
        $positions = $this->positions->setVersion($this->version)->getPositions();

        foreach ($positions as [$centerX, $centerY]) {
            for ($x = -3; $x <= 3; $x++) {
                for ($y = -3; $y <= 3; $y++) {
                    $this->matrix->set(
                        $centerX + $x,
                        $centerY + $y,
                        abs($x) == 3 || abs($y) == 3 || (abs($x) <= 1 && abs($y) <= 1)
                    );
                }
            }
        }

        return $this->matrix;
    }
}
