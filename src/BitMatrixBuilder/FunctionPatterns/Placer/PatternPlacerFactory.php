<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer;

use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\BitMatrixBuilder\PatternPlacerFactoryInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\Positions\PatternPositionsFactory;

final class PatternPlacerFactory implements PatternPlacerFactoryInterface
{
    public static function create(): self
    {
        return new self(PatternPositionsFactory::create());
    }

    private function __construct(
        private readonly PatternPositionsFactoryInterface $patternPositionsFactory,
    ) {
    }

    private function __clone()
    {
    }

    public function createPatternPlacer(FunctionPatternType $patternType): PatternPlacerInterface
    {
        $positions = $this->patternPositionsFactory->createPatternPositions($patternType);

        return match ($patternType) {
            FunctionPatternType::ALIGNMENT_PATTERNS => new AlignmentPatternsPlacer($positions),
            FunctionPatternType::BOTTOM_EXTENSION_PATTERNS => new BottomExtensionPatternsPlacer($positions),
            FunctionPatternType::BOTTOM_RIGHT_EXTENSION_PATTERNS => new BottomRightExtensionPatternsPlacer($positions),
            FunctionPatternType::RIGHT_EXTENSION_PATTERNS => new RightExtensionPatternsPlacer($positions),
            FunctionPatternType::POSITION_DETECTION_PATTERNS => new PositionDetectionPatternsPlacer($positions),
            FunctionPatternType::VERTICAL_TIMING_PATTERNS,
            FunctionPatternType::HORIZONTAL_TIMING_PATTERNS => new TimingPatternsPlacer($positions),
        };
    }
}
