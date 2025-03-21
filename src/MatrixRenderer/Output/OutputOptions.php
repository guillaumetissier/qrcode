<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Output;

use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileTypeExtractor;

class OutputOptions
{
    public const FILENAME = 'filename';
    public const FILETYPE = 'fileType';
    public const QUALITY = 'quality';
    public const SCALE = 'scale';

    private ?string $filename = null;
    private ?FileType $fileType = null;
    private int $quality = 80;
    private int $scale = 10;

    public function __construct(array $options)
    {
        if (isset($options[self::FILENAME]) && is_string($options[self::FILENAME])) {
            $this->filename = $options[self::FILENAME];
        }
        if (isset($options[self::FILETYPE]) && $options[self::FILETYPE] instanceof FileType) {
            $this->fileType = $options[self::FILETYPE];
        }
        if (isset($options[self::QUALITY]) && is_int($options[self::QUALITY])) {
            $this->quality = $options[self::QUALITY];
        }
        if (isset($options[self::SCALE]) && is_int($options[self::SCALE])) {
            $this->scale = $options[self::SCALE];
        }
    }

    /**
     * @throws InvalidOutputOptions
     */
    public function ensureIsValid(): bool
    {
        if (!$this->filename && !$this->fileType) {
            throw new InvalidOutputOptions();
        }

        return true;
    }

    public function getContentType(): ?string
    {
        if ($this->filename) {
            return null;
        }

        return match ($this->fileType) {
            FileType::GIF => 'image/gif',
            FileType::JPG => 'image/jpeg',
            FileType::PNG => 'image/png',
            FileType::PDF => 'application/pdf',
        };
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @throws UnhandledFileTypeException
     */
    public function getFileType(): ?FileType
    {
        if ($this->filename) {
            return FileTypeExtractor::extract($this->filename);
        }

        return $this->fileType;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function getScale(): int
    {
        return $this->scale;
    }
}
