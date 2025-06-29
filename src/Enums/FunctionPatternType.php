<?php

namespace ThePhpGuild\QrCode\Enums;

enum FunctionPatternType
{
    case HORIZONTAL_TIMING_PATTERNS;
    case VERTICAL_TIMING_PATTERNS;
    case POSITION_DETECTION_PATTERNS;
    case ALIGNMENT_PATTERNS;
    case BOTTOM_RIGHT_EXTENSION_PATTERNS;
    case BOTTOM_EXTENSION_PATTERNS;
    case RIGHT_EXTENSION_PATTERNS;
    case DATA_CODEWORDS;

    public static function all(): \Generator
    {
        yield self::HORIZONTAL_TIMING_PATTERNS;
        yield self::VERTICAL_TIMING_PATTERNS;
        yield self::POSITION_DETECTION_PATTERNS;
        yield self::ALIGNMENT_PATTERNS;
        yield self::BOTTOM_RIGHT_EXTENSION_PATTERNS;
        yield self::BOTTOM_EXTENSION_PATTERNS;
        yield self::RIGHT_EXTENSION_PATTERNS;
    }
}
