<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class VerticalTimingPatternsPositions extends AbstractSizeDependentPositions
{
    public function getPositions(): \Generator
    {
        for ($i = 0; $i < $this->getSize(); $i++) {
            yield new Position(6, $i);
        }
    }
}
