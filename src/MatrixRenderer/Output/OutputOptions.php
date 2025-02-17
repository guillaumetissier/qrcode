<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Output;

use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileTypeExtractor;

class OutputOptions
{
    private ?string $filename = null;
    private ?FileType $fileType = null;
    private int $quality = 80;
    private int $scale = 10;

    public function __construct(array $options)
    {
        if (isset($options['filename']) && is_string($options['filename'])) {
            $this->filename = $options['filename'];
        }
        if (isset($options['fileType']) && $options['fileType'] instanceof FileType) {
            $this->fileType = $options['fileType'];
        }
        if (isset($options['quality']) && is_int($options['quality'])) {
            $this->quality = $options['quality'];
        }
        if (isset($options['scale']) && is_int($options['scale'])) {
            $this->quality = $options['scale'];
        }
    }

    /**
     * @throws InvalidOutputOptions
     */
    public function ensureIsValid(): void
    {
        if (!$this->filename && !!$this->fileType) {
            throw new InvalidOutputOptions();
        }
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
