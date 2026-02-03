<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionsInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class InfoModulePlacer implements InfoModulePlacerInterface
{
    private ?BitStringInterface $data = null;

    public function __construct(private readonly InfoModulePositionsInterface $infoModulePositions)
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

    /**
     * @throws MissingInfoException
     */
    public function place(BitMatrix $matrix): void
    {
        if ($this->data === null) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        $p = 0;
        $bits = str_split($this->data->toString());
        foreach ($this->infoModulePositions->positions() as $position) {
            $matrix->setValue($position, intval($bits[$p]));
            $p++;
        }
    }
}
