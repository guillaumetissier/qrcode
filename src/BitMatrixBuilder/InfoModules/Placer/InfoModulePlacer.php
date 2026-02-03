<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionsInterface;

class InfoModulePlacer implements InfoModulePlacerInterface
{
    private ?BitStringInterface $data = null;

    public function __construct(private readonly InfoModulePositionsInterface $positions)
    {
    }

    private function __clone()
    {
    }

    public function withData(BitStringInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function place(BitMatrix $matrix): void
    {
        $bits = str_split($this->data->toString());
        $p = 0;
        foreach ($this->positions as $position) {
            $matrix->setValue($position, $bits[$p]);
            $p++;
        }
    }
}
