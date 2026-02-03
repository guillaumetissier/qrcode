<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns;

use Guillaumetissier\QrCode\Common\Position;

final class FunctionPatternPositions implements FunctionPatternPositionsInterface
{
    public static function empty(): self
    {
        return new self();
    }

    /**
     * @param list<Position> $positions
     * @return self
     */
    public static function fromArray(array $positions): self
    {
        return new self(array_map(fn(Position $p) => $p->toInt(), $positions));
    }

    /**
     * @param int[] $positions
     */
    private function __construct(private array $positions = [])
    {
    }

    private function __clone()
    {
    }

    public function addPosition(Position $position): self
    {
        $this->positions[] = $position->toInt();

        return $this;
    }

    public function isAFunctionPatternPosition(Position $position): bool
    {
        return in_array($position->toInt(), $this->positions);
    }
}
