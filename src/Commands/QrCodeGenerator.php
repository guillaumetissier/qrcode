<?php

namespace ThePhpGuild\QrCode\Commands;

use Psr\Log\LoggerInterface;
use ThePhpGuild\QrCode\Exception;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;
use ThePhpGuild\QrCode\MatrixRenderer\MatrixRendererBuilder;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeDetector;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeIndicator;
use ThePhpGuild\QrCode\Step1DataAnalyser\Step1DataAnalyser;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\Step2DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\LengthBits\LengthBitsFactory;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\PaddingAppender;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\TotalBitsCounterBuilder;
use ThePhpGuild\QrCode\Step2DataEncoder\Step2DataEncoder;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256Operations;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\NumECCodewordsCalculator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\RemainderCalculator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\Step3ErrorCorrectionCoder;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AlignmentPatterns\Placer as AlignmentPatternsDrawer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\AlignmentPatterns\Positions as AlignmentPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\DataCodewords\Placer as DataCodewordsPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FinderPatterns\Placer as FinderPatternsDrawer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\FinderPatterns\Positions as FinderPatternsPositions;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\MatrixBuilder;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\MatrixSizeCalculator;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\PatternPlacer;
use ThePhpGuild\QrCode\Step5MatrixModulesPlacer\TimingPatterns\Placer as TimingPatternsPlacer;

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

            $galloisFields = new Gf256Operations();

            self::$Generator = new QrCodeGenerator(
                new Step1DataAnalyser(
                    new ModeDetector($levelFilteredLogger),
                    new VersionSelectorFactory($levelFilteredLogger),
                    $levelFilteredLogger
                ),
                new Step2DataEncoder(
                    new EncoderFactory($levelFilteredLogger),
                    new PaddingAppender(
                        new TotalBitsCounterBuilder($levelFilteredLogger),
                        new ModeIndicator($levelFilteredLogger),
                        new LengthBitsFactory($levelFilteredLogger),
                    ),
                    $levelFilteredLogger
                ),
                new Step3ErrorCorrectionCoder(
                    new NumECCodewordsCalculator($levelFilteredLogger),
                    new Factory($galloisFields, $levelFilteredLogger),
                    new RemainderCalculator($galloisFields, $levelFilteredLogger),
                    $levelFilteredLogger
                ),
                new MatrixBuilder(
                    new MatrixSizeCalculator(),
                    new TimingPatternsPlacer(),
                    new FinderPatternsDrawer(new FinderPatternsPositions(new MatrixSizeCalculator())),
                    new AlignmentPatternsDrawer(new AlignmentPatternsPositions()),
                    new PatternPlacer(),
                    new DataCodewordsPlacer()
                ),
                new MatrixRendererBuilder(),
                $levelFilteredLogger
            );
        }
        return self::$Generator;
    }

    public function __construct(
        private readonly Step1DataAnalyser         $dataAnalyser,
        private readonly Step2DataEncoder          $dataEncoder,
        private readonly Step3ErrorCorrectionCoder $reedSolomonEncoder,
        private readonly MatrixBuilder             $matrixBuilder,
        private readonly MatrixRendererBuilder     $matrixRendererBuilder,
        private readonly IOLoggerInterface         $logger
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
     * @throws Exception\OutOfRangeException
     * @throws Exception\VariableNotSetException
     */
    public function generate(): void
    {
        $this->logger->notice('*** Step 1. Analyse data ***');

        $mode = $this->dataAnalyser
            ->setData($this->data)
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->getMode();
        $version = $this->dataAnalyser->getVersion();

        $this->logger->notice('*** Step 2. Encode data ***');
        $encodedData = $this->dataEncoder
            ->setData($this->data)
            ->setMode($mode)
            ->setVersion($version)
            ->encode();

        $this->logger->notice('*** Step 3. Code error correction ***');

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
