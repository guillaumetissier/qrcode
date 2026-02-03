<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\Common\Position;
use Guillaumetissier\QrCode\Exception\MissingParameter;

abstract class AbstractMasker implements MaskerInterface
{
    private ?FunctionPatternPositions $functionPatternPositions = null;

    public function withFunctionPatternPositions(FunctionPatternPositions $functionPatternPositions): static
    {
        $this->functionPatternPositions = $functionPatternPositions;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function mask(BitMatrix $originalMatrix): BitMatrix
    {
        if (!$this->functionPatternPositions instanceof FunctionPatternPositions) {
            throw MissingParameter::missingParameter('functionPatternPositions', self::class);
        }

        $maskedMatrix = BitMatrix::fromMatrix($originalMatrix);
        foreach ($maskedMatrix->getValuesFromTopLeft() as $positionValue) {
            [$position, $value] = $positionValue;
            if (!$this->functionPatternPositions->isAFunctionPatternPosition($position)) {
                $maskedMatrix->setValue($position, $this->maskPixel($value, $position));
            }
        }

        return $maskedMatrix;
    }

    abstract protected function maskPixel(int $value, Position $position): int;
}
