<?php

namespace ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FunctionPatternsPlacer;

use ThePhpGuild\QrCode\Enums\FunctionPatternType;

class Factory
{
    public function create(FunctionPatternType $patternType): FunctionPatternPlacerInterface
    {
        return match ($patternType) {
            FunctionPatternType::ALIGNMENT_PATTERNS => new AlignmentPatternsPlacer(),
            FunctionPatternType::DATA_CODEWORDS => new DataCodewordsPlacer(),
            FunctionPatternType::BOTTOM_EXTENSION_PATTERNS => new BottomExtensionPatternsPlacer(),
            FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS => new BottomRightExtensionPatternsPlacer(),
            FunctionPatternType::RIGHT_EXTENSION_PATTERNS => new RightExtensionPatternsPlacer(),
            FunctionPatternType::POSITION_DETECTION_PATTERNS => new PositionDetectionPatternsPlacer(),
            FunctionPatternType::VERTICAL_TIMING_PATTERNS,
            FunctionPatternType::HORIZONTAL_TIMING_PATTERNS => new TimingPatternsPlacer(),
        };
    }
}
