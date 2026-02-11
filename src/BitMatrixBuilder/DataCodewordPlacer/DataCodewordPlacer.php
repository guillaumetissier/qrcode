<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositionsInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class DataCodewordPlacer implements DataCodewordPlacerInterface
{
    private ?BitStringInterface $data = null;

    public static function create(): self
    {
        return new self(DataCodewordPositions::create());
    }

    private function __construct(
        private readonly DataCodewordPositionsInterface $dataCodewordPositions
    ) {
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
    public function place(BitMatrix $matrix, NonDataPositionsInterface $functionPatternPositions): void
    {
        if (!$this->data instanceof BitStringInterface) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        $index = 0;
        $this->dataCodewordPositions->withSize($matrix->size());
        foreach ($this->dataCodewordPositions->positions() as $position) {
            if (!$functionPatternPositions->isAFunctionPatternPosition($position)) {
                $matrix->setValue($position, $this->data->get($index));
                $index++;
            }
        }
    }
}
