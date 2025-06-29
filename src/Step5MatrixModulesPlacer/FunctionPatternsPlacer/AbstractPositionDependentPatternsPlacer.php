<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Matrix\Matrix;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions\PositionsInterface;

abstract class AbstractPositionDependentPatternsPlacer implements FunctionPatternPlacerInterface, PositionsDependent
{
    private ?PositionsInterface $positions = null;

    public function setPositions(PositionsInterface $positions): self
    {
        $this->positions = $positions;

        return $this;
    }

    public function getPositions(): \Generator
    {
        return $this->positions->getPositions();
    }

    abstract public function place(Matrix $matrix): void;
}
