<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions;

use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PatternPositionsFactoryInterface;

final class PatternPositionsFactory implements PatternPositionsFactoryInterface
{
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

    public function createPatternPositions(FunctionPatternType $patternType): PatternPositionsInterface
    {
        return match ($patternType) {
            FunctionPatternType::ALIGNMENT_PATTERNS => new AlignmentPatternCenterPositions(),
            FunctionPatternType::POSITION_DETECTION_PATTERNS => new FinderPatternCenterPositions(),
            FunctionPatternType::HORIZONTAL_TIMING_PATTERNS => new HorizontalTimingPatternPositions(),
            FunctionPatternType::VERTICAL_TIMING_PATTERNS => new VerticalTimingPatternPositions(),
            FunctionPatternType::BOTTOM_EXTENSION_PATTERNS => new BottomExtensionPatternPositions(),
            FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS => new BottomRightExtensionPatternPositions(),
            FunctionPatternType::RIGHT_EXTENSION_PATTERNS => new RightExtensionPatternPositions(),
        };
    }
}
