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
            FunctionPatternType::POSITION_DETECTION_PATTERNS => new FinderPatternsCenterPositions(),
            FunctionPatternType::HORIZONTAL_TIMING_PATTERNS => new HorizontalTimingPatternsPositions(),
            FunctionPatternType::VERTICAL_TIMING_PATTERNS => new VerticalTimingPatternsPositions(),
            FunctionPatternType::BOTTOM_EXTENSION_PATTERNS => new BottomExtensionPatternsPositions(),
            FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS => new BottomRightExtensionPatternsPositions(),
            FunctionPatternType::RIGHT_EXTENSION_PATTERNS => new RightExtensionPatternsPositions(),
        };
    }
}
