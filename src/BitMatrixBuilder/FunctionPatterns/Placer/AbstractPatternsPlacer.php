<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\PositionsInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;

abstract class AbstractPatternsPlacer implements PatternPlacerInterface
{
    public function __construct(private readonly ?PatternPositionsInterface $positions = null)
    {
    }

    public function withVersion(Version $version): self
    {
        $this->positions->withVersion($version);

        return $this;
    }

    abstract public function place(BitMatrix $matrix, FunctionPatternPositions $functionPatternPositions): void;

    /**
     * @return Generator<Position>
     *
     * @throws MissingParameter
     */
    protected function positions(): Generator
    {
        if (!$this->positions instanceof PositionsInterface) {
            throw MissingParameter::missingParameter('positions', self::class);
        }

        return $this->positions->positions();
    }
}
