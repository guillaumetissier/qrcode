<?php

namespace ThePhpGuild\QrCode\Commands;

use Psr\Log\LoggerInterface;
use ThePhpGuild\QrCode\BitsString\CharCountIndicator;
use ThePhpGuild\QrCode\BitsString\ModeIndicator;
use ThePhpGuild\QrCode\BitsString\Terminator;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Exception;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;
use ThePhpGuild\QrCode\MatrixRenderer\MatrixRendererBuilder;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;
use ThePhpGuild\QrCode\Polynomial\Operations\Gf256PolynomialOperations;
use ThePhpGuild\QrCode\Scalar\Gf256;
use ThePhpGuild\QrCode\Step1DataAnalyser\Mode\ModeDetector;
use ThePhpGuild\QrCode\Step1DataAnalyser\Step1DataAnalyser;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector\VersionSelectorFactory;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter;
use ThePhpGuild\QrCode\Step2DataEncodation\DataCodewordsCounter\Factory as DataCodewordsCounterFactory;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\Factory;
use ThePhpGuild\QrCode\Step2DataEncodation\Step2DataEncoder;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Factory as GeneratorPolynomialFactory;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial\Gf256BinomialGenerator;
use ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\NumECCodewordsCalculator;
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

            self::$Generator = new QrCodeGenerator(
                new Step1DataAnalyser(
                    new ModeDetector($levelFilteredLogger),
                    new VersionSelectorFactory($levelFilteredLogger),
                    $levelFilteredLogger
                ),
                new Step2DataEncoder(
                    new Factory($levelFilteredLogger),
                    new ModeIndicator(),
                    new CharCountIndicator(),
                    new Terminator(),
                    new DataCodewordsCounter(new DataCodewordsCounterFactory()),
                    $levelFilteredLogger
                ),
                new Step3ErrorCorrectionCoder(
                    new NumECCodewordsCalculator($levelFilteredLogger),
                    new GeneratorPolynomialFactory(
                        new Gf256BinomialGenerator(Gf256::getInstance()),
                        Gf256PolynomialOperations::getInstance(),
                        $levelFilteredLogger
                    ),
                    Gf256PolynomialOperations::getInstance(),
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
        private readonly Step3ErrorCorrectionCoder $errorCorrectionCoder,
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
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->encode();
        $this->logger->notice("*** Step 2. Encoded data = $encodedData");

        $this->logger->notice('*** Step 3. Code error correction ***');
        $dataWithErrorCorrection = $this->errorCorrectionCoder
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->setVersion($version)
            ->addErrorCorrection($encodedData);
        $this->logger->notice("*** Step 3. Data with error correction = $dataWithErrorCorrection");

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
