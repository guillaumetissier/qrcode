<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns;

use Generator;
use Guillaumetissier\QrCode\Common\Position;

final class NonDataPositions implements NonDataPositionsInterface
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

    /**
     * @param ?Generator<Position> $positions
     * @return $this
     */
    public function addPositions(?Generator $positions): self
    {
        if ($positions !== null) {
            foreach ($positions as $position) {
                $this->positions[] = $position->toInt();
            }
        }

        return $this;
    }

    public function isAFunctionPatternPosition(Position $position): bool
    {
        return in_array($position->toInt(), $this->positions);
    }
}
