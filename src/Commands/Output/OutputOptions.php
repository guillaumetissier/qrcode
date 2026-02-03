<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Commands\Output;

use Guillaumetissier\QrCode\Exception\InvalidOutputOptionsException;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileTypeExtractor;

final class OutputOptions implements OutputOptionsInterface
{
    public const FILENAME = 'filename';
    public const FILETYPE = 'fileType';
    public const QUALITY = 'quality';
    public const SCALE = 'scale';

    private ?string $filename = null;
    private ?FileType $fileType = null;
    private int $quality = 80;
    private int $scale = 10;

    /**
     * @param array<string, int|string|FileType>  $options
     * @throws InvalidOutputOptionsException
     */
    public function __construct(array $options)
    {
        if (is_string($options[self::FILENAME] ?? false)) {
            $this->filename = $options[self::FILENAME];
        }
        if (isset($options[self::FILETYPE]) && $options[self::FILETYPE] instanceof FileType) {
            $this->fileType = $options[self::FILETYPE];
        }
        if (!$this->filename && !$this->fileType) {
            throw InvalidOutputOptionsException::allVariablesNull(['filename', 'fileType']);
        }
        if (is_int($options[self::QUALITY] ?? false)) {
            if ($options[self::QUALITY] < 1 || $options[self::QUALITY] > 100) {
                throw InvalidOutputOptionsException::outOfRange('quality', $options[self::QUALITY], 1, 100);
            }
            $this->quality = $options[self::QUALITY];
        }
        if (is_int($options[self::SCALE] ?? false)) {
            if ($options[self::SCALE] < 1 || $options[self::SCALE] > 20) {
                throw InvalidOutputOptionsException::outOfRange('scale', $options[self::SCALE], 1, 20);
            }
            $this->scale = $options[self::SCALE];
        }
    }

    /**
     * @return string|null
     * @throws MissingInfoException
     */
    public function contentType(): ?string
    {
        if ($this->filename) {
            return null;
        }

        return match ($this->fileType) {
            FileType::GIF => 'image/gif',
            FileType::JPG => 'image/jpeg',
            FileType::PNG => 'image/png',
            FileType::PDF => 'application/pdf',
            null => throw MissingInfoException::missingInfo('fileType', self::class),
        };
    }

    public function filename(): ?string
    {
        return $this->filename;
    }

    /**
     * @return FileType
     * @throws MissingInfoException
     * @throws UnhandledFileTypeException
     */
    public function fileType(): FileType
    {
        if ($this->filename) {
            return FileTypeExtractor::extract($this->filename);
        }

        if (!$this->fileType instanceof FileType) {
            throw MissingInfoException::missingInfo('fileType', self::class);
        }

        return $this->fileType;
    }

    public function quality(): int
    {
        return $this->quality;
    }

    public function scale(): int
    {
        return $this->scale;
    }
}
