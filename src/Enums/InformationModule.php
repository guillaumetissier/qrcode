<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Enums;

enum InformationModule: string
{
    case HORIZONTAL_FORMAT_INFO = 'Horizontal format info';
    case VERTICAL_FORMAT_INFO = 'Vertical format info';
    case BOTTOM_LEFT_VERSION_INFO = 'Bottom left version info';
    case TOP_RIGHT_VERSION_INFO = 'Top right version info';

    /**
     * @return InformationModule[]
     */
    public static function all(): array
    {
        return [
            self::HORIZONTAL_FORMAT_INFO,
            self::VERTICAL_FORMAT_INFO,
            self::BOTTOM_LEFT_VERSION_INFO,
            self::TOP_RIGHT_VERSION_INFO,
        ];
    }
}
