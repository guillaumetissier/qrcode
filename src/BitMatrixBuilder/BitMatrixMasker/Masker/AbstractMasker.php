<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositionsInterface;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

abstract class AbstractMasker implements MaskerInterface
{
    private ?FunctionPatternPositionsInterface $functionPatternPositions = null;

    public function withFunctionPatternPositions(FunctionPatternPositionsInterface $functionPatternPositions): static
    {
        $this->functionPatternPositions = $functionPatternPositions;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function mask(BitMatrix $originalMatrix): BitMatrix
    {
        if (!$this->functionPatternPositions instanceof FunctionPatternPositions) {
            throw MissingInfoException::missingInfo('functionPatternPositions', self::class);
        }

        $maskedMatrix = BitMatrix::fromMatrix($originalMatrix);
        foreach ($maskedMatrix->getValuesFromTopLeft() as $positionValue) {
            [$position, $value] = $positionValue;
            if ($value === null) {
                continue;
            }
            if (!$this->functionPatternPositions->isAFunctionPatternPosition($position)) {
                $maskedMatrix->setValue($position, $this->maskPixel($value, $position));
            }
        }

        return $maskedMatrix;
    }

    abstract protected function maskPixel(int $value, Position $position): int;
}
