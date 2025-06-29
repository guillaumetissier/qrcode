<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

class FinderPatternsCenterPositions extends AbstractSizeDependentPositions
{
    public function getPositions(): \Generator
    {
        yield new Position(3, 3);
        yield new Position($this->getSize() - 4, 3);
        yield new Position(3, $this->getSize() - 4);
    }
}
