<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

interface PositionsDependent
{
    public function setPositions(PositionsInterface $positions): self;
}
