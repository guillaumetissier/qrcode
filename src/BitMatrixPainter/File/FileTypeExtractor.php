<?php

namespace Guillaumetissier\QrCode\BitMatrixPainter\File;

use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;

class FileTypeExtractor
{
    /**
     * @throws UnhandledFileTypeException
     */
    public static function extract(string $filename): FileType
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
