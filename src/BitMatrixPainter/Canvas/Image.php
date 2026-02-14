<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter\Canvas;

use GdImage;
use Guillaumetissier\QrCode\Common\OutputOptionsDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;
use Guillaumetissier\QrCode\Exception\ColorException;
use Guillaumetissier\QrCode\BitMatrixPainter\File\FileType;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class Image implements CanvasInterface
{
    use OutputOptionsDependentTrait;

    public const BLACK = 'black';
    public const WHITE = 'white';

    private GdImage $image;

    /**
     * @var array<string, int>
     */
    private array $palette = [];

    public static function create(int $width, int $height, ?IOLoggerInterface $logger = null): self
    {
        return new self($width, $height, $logger);
    }

    /**
     * @throws ColorException
     */
    private function __construct(int $width, int $height, private readonly ?IOLoggerInterface $logger = null)
    {
        $this->image = imagecreatetruecolor($width, $height);
        $this->addColorToPalette(self::BLACK, 0, 0, 0);
        $this->addColorToPalette(self::WHITE, 255, 255, 255);
    }

    private function __clone()
    {
    }

    public function __destruct()
    {
        imagedestroy($this->image);
    }

    /**
     * @throws ColorException
     */
    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self
    {
        if (false === ($color = imagecolorallocate($this->image, $red, $green, $blue))) {
            throw ColorException::cannotAllocateColor($colorName, [$red, $green, $blue]);
        }
        $this->palette[$colorName] = $color;

        return $this;
    }

    /**
     * @throws ColorException
     */
    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool
    {
        if (!isset($this->palette[$colorName])) {
            throw ColorException::colorNotFound($colorName);
        }

        return imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $this->palette[$colorName]);
    }

    /**
     * @return bool
     * @throws UnhandledFileTypeException
     * @throws MissingInfoException
     */
    public function output(): bool
    {
        $outputOptions = $this->outputOptions();

        if (null !== ($filename = $outputOptions->filename())) {
            $this->logger?->debug('Save QR Code in file ' . $filename);
        } else {
            header("Content-Type: {$outputOptions->contentType()}");
            $this->logger?->debug('Send QR Code to browser ');
        }

        return match ($outputOptions->fileType()) {
            FileType::GIF => imagegif(
                $this->image,
                $filename
            ),
            FileType::JPG => imagejpeg(
                $this->image,
                $filename,
                $outputOptions->quality()
            ),
            FileType::PNG => imagepng(
                $this->image,
                $filename,
                $this->convertQualityToCompression($outputOptions->quality())
            ),
            default => throw new UnhandledFileTypeException(),
        };
    }

    /**
     * Convert quality (0-100) to PNG compression level (0-9)
     */
    private function convertQualityToCompression(?int $quality): int
    {
        if ($quality === null) {
            return 6; // Default PNG compression
        }

        // Inverse: quality 100 = compression 0, quality 0 = compression 9
        return (int) round(9 - ($quality / 100 * 9));
    }
}
