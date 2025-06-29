<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class HorizontalTimingPatternsPositions extends AbstractSizeDependentPositions
{
    public function getPositions(): \Generator
    {
        for ($i = 0; $i < $this->getSize(); $i++) {
            yield new Position($i, 6);
        }
    }
}
