<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer;

use Generator;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class DataCodewordPositions implements DataCodewordPositionsInterface
{
    private ?int $size = null;

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

    public function withSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Generator<Position>
     * @throws MissingInfoException
     */
    public function positions(): Generator
    {
        if (null === $this->size) {
            throw MissingInfoException::missingInfo('size', self::class);
        }

        $direction = 1;
        $max = $this->size * ($this->size - 1);
        $row = 0;
        for ($i = 0; $i < $max; $i++) {
            $column = 2 * (int)floor($i / (2 * $this->size)) + $i % 2;
            if ($column >= $this->size - 7) {
                $column++;
            }
            yield Position::fromBottomRight($column, $row, $this->size);
            if ($i % 2 === 1) {
                $row += $direction;
                if ($row === $this->size) {
                    $direction = -1;
                    $row = $this->size - 1;
                } elseif ($row === -1) {
                    $direction = 1;
                    $row = 0;
                }
            }
        }
    }
}
