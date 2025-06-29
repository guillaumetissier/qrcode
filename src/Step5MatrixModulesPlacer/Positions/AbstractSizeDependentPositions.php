<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

abstract class AbstractSizeDependentPositions implements PositionsInterface, SizeDependent
{
    private ?int $size = null;

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    abstract public function getPositions(): \Generator;
}
