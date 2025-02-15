<?php

namespace ThePhpGuild\Qrcode;

use ThePhpGuild\Qrcode\DataEncoder\DataEncoder;
use ThePhpGuild\Qrcode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\Qrcode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\Qrcode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\Qrcode\DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\Qrcode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\GalloisField;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\NumECCodewordsCalculator;
use ThePhpGuild\Qrcode\ErrorCorrectionEncoder\ReedSolomonEncoder;
use ThePhpGuild\Qrcode\File\FileType;
use ThePhpGuild\Qrcode\File\FileTypeExtractor;
use ThePhpGuild\Qrcode\Matrix\MatrixBuilder;
use ThePhpGuild\Qrcode\Matrix\PlaceAlignmentPatterns;
use ThePhpGuild\Qrcode\Matrix\PlaceDataAndErrorCorrection;
use ThePhpGuild\Qrcode\Matrix\PlaceFinderPatterns;
use ThePhpGuild\Qrcode\Matrix\PlaceFormatAndVersionInfo;
use ThePhpGuild\Qrcode\Matrix\PlaceTimingPatterns;
use ThePhpGuild\Qrcode\MatrixRenderer\MatrixRendererFactory;

class QrCodeGenerator
{
    static private ?QrCodeGenerator $Generator = null;

    private string $data;
    private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::LOW;
    private ?string $filename = null;
    private FileType $fileType = FileType::PNG;
    private ?Version $version = null;

    public static function getQrCodeGenerator(): self
    {
        if (!self::$Generator) {
            self::$Generator = new QrCodeGenerator(
                new DataEncoder(
                    new ModeDetector(),
                    new VersionSelectorFactory(),
                    new EncoderFactory(),
                    new PaddingAppender(
                        new TotalBitsCounterBuilder(),
                        new ModeIndicator(),
                        new LengthBitsFactory()
                    )
                ),
                new ReedSolomonEncoder(
                    new GalloisField(),
                    new NumECCodewordsCalculator()
                ),
                new MatrixBuilder(
                    new PlaceFinderPatterns(),
                    new PlaceAlignmentPatterns(),
                    new PlaceTimingPatterns(),
                    new PlaceFormatAndVersionInfo(),
                    new PlaceDataAndErrorCorrection()
                ),
                new MatrixRendererFactory(),
                new FileTypeExtractor()
            );
        }
        return self::$Generator;
    }

    public function __construct(
        private readonly DataEncoder $dataEncoder,
        private readonly ReedSolomonEncoder $reedSolomonEncoder,
        private readonly MatrixBuilder $matrixBuilder,
        private readonly MatrixRendererFactory $matrixRendererFactory,
        private readonly FileTypeExtractor $fileTypeExtractor
    )
    {
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        $this->fileType = $this->fileTypeExtractor->extract($filename);

        return $this;
    }

    public function setFileType(FileType $fileType): self
    {
        $this->filename = null;
        $this->fileType = $fileType;

        return $this;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function generate(): void
    {
        $encodedData = $this->dataEncoder
            ->setData($this->data)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->encode();

        $dataWithErrorCorrection = $this->reedSolomonEncoder
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->setVersion($this->version)
            ->addErrorCorrection(str_split($encodedData));

        $matrix = $this->matrixBuilder
            ->setVersion($this->version)
            ->setData(implode($dataWithErrorCorrection))
            ->build();

        $this->matrixRendererFactory
            ->getRenderer($this->fileType)
            ->setFilename($this->filename)
            ->setMatrix($matrix)
            ->render();
    }
}

