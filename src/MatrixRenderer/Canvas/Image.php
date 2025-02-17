<?php

namespace ThePhpGuild\QrCode\MatrixRenderer\Canvas;

use ThePhpGuild\QrCode\Exception\ImageNotCreatedException;
use ThePhpGuild\QrCode\Exception\InvalidOutputOptions;
use ThePhpGuild\QrCode\Exception\UnhandledFileTypeException;
use ThePhpGuild\QrCode\MatrixRenderer\File\FileType;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputInterface;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class Image implements CanvasInterface, OutputInterface
{
    const BLACK = 'black';
    const WHITE = 'white';

    private \GdImage $image;
    private array $palette = [];

    /**
     * @throws ImageNotCreatedException
     */
    public function __construct(int $width, int $height)
    {
        $this->image = imagecreatetruecolor($width, $height);

        if (!$this->image) {
            throw new ImageNotCreatedException();
        }

        $this->addColorToPalette(self::BLACK, 0, 0, 0);
        $this->addColorToPalette(self::WHITE, 255, 255, 255);
    }

    public function addColorToPalette(string $colorName, int $red, int $green, int $blue): self
    {
        $this->palette[$colorName] = imagecolorallocate($this->image, $red, $green, $blue);

        return $this;
    }

    public function paintRectangle(string $colorName, int $x1, int $y1, int $x2, int $y2): bool
    {
        return imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $this->palette[$colorName]);
    }

    /**
     * @throws UnhandledFileTypeException
     * @throws InvalidOutputOptions
     */
    public function output(OutputOptions $options): bool
    {
        $options->ensureIsValid();

        if (null !== ($contentType = $options->getContentType())) {
            header("Content-Type: ${contentType}");
        }

        return match ($options->getFileType()) {
            FileType::GIF => imagegif($this->image, $options->getFilename()),
            FileType::PNG => imagejpeg($this->image, $options->getFilename(), $options->getQuality()),
            FileType::JPG => imagepng($this->image, $options->getFilename(), $options->getQuality()),
            default => throw new UnhandledFileTypeException(),
        };
    }
}
