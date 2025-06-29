<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\Positions;

use ThePhpGuild\QrCode\Enums\FunctionPatternType;

class Factory
{
    public function create(FunctionPatternType $patternType): ?PositionsInterface
    {
        return match ($patternType) {
            FunctionPatternType::ALIGNMENT_PATTERNS => new AlignmentPatternsCenterPositions(),
            FunctionPatternType::DATA_CODEWORDS => new DataCodewordPositions(),
            FunctionPatternType::EXTENSION_PATTERNS => new ExtensionPatternsPositions(),
            FunctionPatternType::POSITION_DETECTION_PATTERNS => new FinderPatternsCenterPositions(),
            FunctionPatternType::HORIZONTAL_TIMING_PATTERNS => new HorizontalTimingPatternsPositions(),
            FunctionPatternType::VERTICAL_TIMING_PATTERNS => new VerticalTimingPatternsPositions(),
            default => null,
        };
    }
}
