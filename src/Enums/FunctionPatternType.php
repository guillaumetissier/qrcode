<?php

namespace ThePhpGuild\QrCode\Enums;

enum FunctionPatternType
{
    case ALIGNMENT_PATTERNS;
    case EXTENSION_PATTERNS;
    case POSITION_DETECTION_PATTERNS;
    case HORIZONTAL_TIMING_PATTERNS;
    case VERTICAL_TIMING_PATTERNS;
    case DATA_CODEWORDS;

    public static function all(): array
    {
        return [
            self::HORIZONTAL_TIMING_PATTERNS,
            self::VERTICAL_TIMING_PATTERNS,
            self::POSITION_DETECTION_PATTERNS,
            self::ALIGNMENT_PATTERNS,
            self::EXTENSION_PATTERNS,
        ];
    }
}
