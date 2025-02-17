<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\File;

use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;

class FileTypeExtractor
{
    /**
     * @throws UnhandledFileTypeException
     */
    public static function extract($filename): FileType
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        return match ($extension) {
            'gif' => FileType::GIF,
            'pdf' => FileType::PDF,
            'png' => FileType::PNG,
            'jpeg', 'jpg' => FileType::JPG,
            default => throw new UnhandledFileTypeException($extension),
        };
    }
}
