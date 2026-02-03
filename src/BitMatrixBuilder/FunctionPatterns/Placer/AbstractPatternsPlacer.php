<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Common\PositionsInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

abstract class AbstractPatternsPlacer implements PatternPlacerInterface
{
    public function __construct(private readonly PatternPositionsInterface $positions)
    {
    }

    public function withVersion(Version $version): self
    {
        $this->positions->withVersion($version);

        return $this;
    }

    abstract public function place(
        BitMatrix $matrix,
        FunctionPatternPositionsInterface $functionPatternPositions
    ): void;

    /**
     * @return Generator<Position>
     *
     * @throws MissingInfoException
     */
    protected function positions(): Generator
    {
        if (!$this->positions instanceof PositionsInterface) {
            throw MissingInfoException::missingInfo('positions', self::class);
        }

        return $this->positions->positions();
    }
}
