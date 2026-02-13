<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositionsInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

abstract class AbstractPatternsPlacer implements PatternPlacerInterface
{
    use VersionDependentTrait;

    public function __construct(private readonly PatternPositionsInterface $positions)
    {
    }

    abstract public function place(
        BitMatrix $matrix,
        NonDataPositionsInterface $functionPatternPositions
    ): void;

    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    protected function positions(): Generator
    {
        $version = $this->version();

        return $this->positions->withVersion($version)->positions();
    }
}
