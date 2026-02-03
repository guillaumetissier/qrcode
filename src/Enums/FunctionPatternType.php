<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum FunctionPatternType: string
{
    case HORIZONTAL_TIMING_PATTERNS = 'Horizontal timing pattens';
    case VERTICAL_TIMING_PATTERNS = 'Vertical timing pattens';
    case POSITION_DETECTION_PATTERNS = 'Position detection pattens';
    case ALIGNMENT_PATTERNS = 'Alignment pattens';
    case BOTTOM_RIGHT_EXTENSION_PATTERNS = 'Bottom right extension pattens';
    case BOTTOM_EXTENSION_PATTERNS = 'Bottom extension pattens';
    case RIGHT_EXTENSION_PATTERNS = 'Right extension pattens';

    /**
     * @return FunctionPatternType[]
     */
    public static function all(): array
    {
        return [
            self::HORIZONTAL_TIMING_PATTERNS,
            self::VERTICAL_TIMING_PATTERNS,
            self::POSITION_DETECTION_PATTERNS,
            self::ALIGNMENT_PATTERNS,
            self::BOTTOM_RIGHT_EXTENSION_PATTERNS,
            self::BOTTOM_EXTENSION_PATTERNS,
            self::RIGHT_EXTENSION_PATTERNS,
        ];
    }
}
