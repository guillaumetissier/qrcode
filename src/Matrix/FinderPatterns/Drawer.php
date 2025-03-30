<?php

namespace ThePhpGuild\QrCode\Matrix\FinderPatterns;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Matrix\AbstractPatternDrawer;
use ThePhpGuild\QrCode\Matrix\QrMatrix;

class Drawer extends AbstractPatternDrawer
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

    public function draw(): QrMatrix
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
