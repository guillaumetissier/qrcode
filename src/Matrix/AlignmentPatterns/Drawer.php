<?php

namespace ThePhpGuild\QrCode\Matrix\AlignmentPatterns;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Matrix\AbstractPatternDrawer;
use ThePhpGuild\QrCode\Matrix\QrMatrix;

class Drawer extends AbstractPatternDrawer
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

    public function draw(): QrMatrix
    {
        if ($this->version->value < 2) {
            return $this->matrix;
        }

        $alignmentPositions = $this->positions->getPositions();

        foreach ($alignmentPositions as $coordinates) {
            [$x, $y] = $coordinates;
            for ($i = -2; $i <= 2; $i++) {
                for ($j = -2; $j <= 2; $j++) {
                    $this->matrix->set(
                        $x + $i,
                        $y + $j,
                        (abs($i) == 2 || abs($j) == 2 || ($i == 0 && $j == 0))
                    );
                }
            }
        }

        return $this->matrix;
    }
}
