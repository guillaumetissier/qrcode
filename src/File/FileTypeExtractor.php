<?php

namespace ThePhpGuild\QrCode\File;

class FileTypeExtractor
{
    public function extract($filename): FileType
    {
        return match (pathinfo($filename, PATHINFO_EXTENSION)) {
            'gif' => FileType::GIF,
            'pdf' => FileType::PDF,
            'png' => FileType::PNG,
            'jpeg', 'jpg' => FileType::JPG,
        };
    }
}
