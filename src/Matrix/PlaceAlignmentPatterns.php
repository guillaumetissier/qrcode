<?php

namespace ThePhpGuild\Qrcode\Matrix;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class PlaceAlignmentPatterns extends AbstractPlacePatterns
{
    private ?Version $version = null;

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function execute(): QrMatrix
    {
        if ($this->version->toInt() < 2) {
            return $this->matrix;
        }

        $alignmentPositions = $this->getAlignmentPatternPositions();

        foreach ($alignmentPositions as $x) {
            foreach ($alignmentPositions as $y) {
                if (($x == 6 && $y == 6) ||
                    ($x == 6 && $y == $this->matrix->getSize() - 7) ||
                    ($x == $this->matrix->getSize() - 7 && $y == 6)
                ) {
                    continue;
                }

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
        }

        return $this->matrix;
    }

    private function getAlignmentPatternPositions(): array
    {
        $positions = [6];
        $step = ($this->matrix->getSize() - 13) / (floor($this->version->toInt() / 7) + 1);

        for ($pos = $this->matrix->getSize() - 7; $pos > 6; $pos -= $step) {
            array_unshift($positions, (int)$pos);
        }

        return $positions;
    }
}
