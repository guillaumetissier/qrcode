<?php

namespace ThePhpGuild\QrCode\Commands;

use Psr\Log\LoggerInterface;
use ThePhpGuild\QrCode\DataEncoder\DataEncoder;
use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeDetector;
use ThePhpGuild\QrCode\DataEncoder\Mode\ModeIndicator;
use ThePhpGuild\QrCode\DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\QrCode\DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;
use ThePhpGuild\QrCode\DataEncoder\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\GalloisField;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\GeneratorPolynomialCreator;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ReedSolomonEncoder;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\RemainderCalculator;
use ThePhpGuild\QrCode\Exception;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;
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

    public static function getQrCodeGenerator(?LoggerInterface $logger = null, ?string $logLevel = null): self
    {
        if (!self::$Generator) {
            $levelFilteredLogger = new LevelFilteredLogger($logger);
            if ($logLevel) {
                $levelFilteredLogger->setLogLevel($logLevel);
            }

            $galloisFields = new GalloisField();

            self::$Generator = new QrCodeGenerator(
                new DataEncoder(
                    new ModeDetector(clone $levelFilteredLogger),
                    new VersionSelectorFactory(clone $levelFilteredLogger),
                    new EncoderFactory(clone $levelFilteredLogger),
                    new PaddingAppender(
                        new TotalBitsCounterBuilder(clone $levelFilteredLogger),
                        new ModeIndicator(clone $levelFilteredLogger),
                        new LengthBitsFactory(clone $levelFilteredLogger),
                    ),
                    clone $levelFilteredLogger
                ),
                new ReedSolomonEncoder(
                    new NumECCodewordsCalculator(clone $levelFilteredLogger),
                    new GeneratorPolynomialCreator($galloisFields, clone $levelFilteredLogger),
                    new RemainderCalculator($galloisFields, clone $levelFilteredLogger),
                    clone $levelFilteredLogger
                ),
                new MatrixBuilder(
                    new PlaceFinderPatterns(),
                    new PlaceAlignmentPatterns(),
                    new PlaceTimingPatterns(),
                    new PlaceFormatAndVersionInfo(),
                    new PlaceDataAndErrorCorrection()
                ),
                new MatrixRendererBuilder(),
                $levelFilteredLogger
            );
        }
        return self::$Generator;
    }

    public function __construct(
        private readonly DataEncoder $dataEncoder,
        private readonly ReedSolomonEncoder $reedSolomonEncoder,
        private readonly MatrixBuilder $matrixBuilder,
        private readonly MatrixRendererBuilder $matrixRendererBuilder,
        private readonly IOLoggerInterface $logger
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
        $this->logger->notice('*** 1. Encoding data ***');

        $encodedData = $this->dataEncoder
            ->setData($this->data)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->encode();

        $version = $this->dataEncoder->getVersion();

        $this->logger->notice('*** 2. Adding error correction ***');

        $dataWithErrorCorrection = $this->reedSolomonEncoder
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->setVersion($version)
            ->addErrorCorrection(str_split($encodedData));

//        $this->logger->notice('*** 3. Building QR code matrix ***');
//
//        $matrix = $this->matrixBuilder
//            ->setVersion($version)
//            ->setData(implode($dataWithErrorCorrection))
//            ->build();
//
//        $this->logger->notice('*** 4. Rendering QR code matrix ***');
//
//        $this->matrixRendererBuilder
//            ->buildRenderer($this->outputOptions)
//            ->setMatrix($matrix)
//            ->render();

        $this->logger->notice('*** QR code was generated ***');
    }
}
