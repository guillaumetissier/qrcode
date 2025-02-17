<?php

namespace ThePhpGuild\QrCode;

use ThePhpGuild\QrCode\DataEncoder\DataEncoder;
use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\GalloisField;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ReedSolomonEncoder;
use ThePhpGuild\QrCode\Matrix\MatrixBuilder;
use ThePhpGuild\QrCode\Matrix\PlaceAlignmentPatterns;
use ThePhpGuild\QrCode\Matrix\PlaceDataAndErrorCorrection;
use ThePhpGuild\QrCode\Matrix\PlaceFinderPatterns;
use ThePhpGuild\QrCode\Matrix\PlaceFormatAndVersionInfo;
use ThePhpGuild\QrCode\Matrix\PlaceTimingPatterns;
use ThePhpGuild\QrCode\MatrixRenderer\MatrixRendererBuilder;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class QrCodeGenerator
{
    static private ?QrCodeGenerator $Generator = null;

    private string $data;
    private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::LOW;
    private ?OutputOptions $outputOptions = null;
    private ?Version $version = null;

    public static function getQrCodeGenerator(): self
    {
        if (!self::$Generator) {
            self::$Generator = new QrCodeGenerator(
                new DataEncoder(
                    new ModeDetector(),
                    new VersionSelectorFactory(
                        new VersionFromIntConverter()
                    ),
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
                new MatrixRendererBuilder()
            );
        }
        return self::$Generator;
    }

    public function __construct(
        private readonly DataEncoder           $dataEncoder,
        private readonly ReedSolomonEncoder    $reedSolomonEncoder,
        private readonly MatrixBuilder         $matrixBuilder,
        private readonly MatrixRendererBuilder $matrixRendererBuilder
    )
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setOutputOptions(OutputOptions $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }

    /**
     * @throws Exception\NoDataException
     * @throws Exception\OutOfRangeException
     * @throws Exception\UnhandledFileTypeException
     * @throws Exception\VariableNotSetException
     */
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

        $this->matrixRendererBuilder
            ->buildRenderer($this->outputOptions)
            ->setMatrix($matrix)
            ->render();
    }
}
