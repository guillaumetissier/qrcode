<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Common\SizeDependentPositionsInterface;
use Guillaumetissier\QrCode\Exception\MissingParameter;

final class DataCodewordPlacer implements DataCodewordPlacerInterface
{
    private ?BitStringInterface $data = null;

    private ?SizeDependentPositionsInterface $positions = null;

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
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

    public function withPositions(SizeDependentPositionsInterface $positions): self
    {
        $this->positions = $positions;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void
    {
        if (!$this->data instanceof BitStringInterface) {
            throw MissingParameter::missingParameter('data', self::class);
        }

        if (!$this->positions instanceof SizeDependentPositionsInterface) {
            throw MissingParameter::missingParameter('positions', self::class);
        }

        $index = 0;
        $this->positions->withSize($matrix->size());
        foreach ($this->positions->positions() as $position) {
            if (!$functionPatternPositions->isAFunctionPatternPosition($position)) {
                $matrix->setValue($position, $this->data->get($index));
                $index++;
            }
        }
    }
}
