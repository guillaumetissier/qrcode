<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\DataDependentTrait;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Mode\ModeDetector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\VersionSelectorFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataEncoder;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\ErrorCorrectionCalculator;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\FinalCodewordsAssembler;
use Guillaumetissier\QrCode\EncoderInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class Encoder implements EncoderInterface
{
    use DataDependentTrait;
    use ErrorCorrectionLevelDependentTrait;

    private ?Version $version = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            ModeDetector::create($logger),
            VersionSelectorFactory::create($logger),
            DataEncoder::create($logger),
            ErrorCorrectionCalculator::create($logger),
            FinalCodewordsAssembler::create($logger),
            $logger
        );
    }

    private function __construct(
        private readonly ModeDetectorInterface $modeDetector,
        private readonly VersionSelectorFactoryInterface $versionSelectorFactory,
        private readonly DataEncoderInterface $dataEncoder,
        private readonly ErrorCorrectionCalculatorInterface $errorCorrectionCoder,
        private readonly FinalCodewordsAssemblerInterface $finalCodewordsAssembler,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    public function version(): Version
    {
        if ($this->version === null) {
            throw MissingInfoException::wasNotComputed("version", self::class);
        }

        return $this->version;
    }

    /**
     * @throws MissingInfoException
     */
    public function encode(): BitStringInterface
    {
        $data = $this->data();
        $errorCorrectionLevel = $this->errorCorrectionLevel();

        $this->logger?->notice('------ Detecting mode ------', ['class' => self::class]);

        $mode = $this->modeDetector->withData($data)->detect();

        $this->logger?->notice('------ Detecting version ------', ['class' => self::class]);

        $this->version = $this->versionSelectorFactory
            ->getVersionSelector($mode, $errorCorrectionLevel)
            ->selectVersion(strlen($data));

        $this->logger?->notice('------ Encoding data ------', ['class' => self::class]);

        $encodedBitString = $this->dataEncoder
            ->withData($data)
            ->withMode($mode)
            ->withVersion($this->version)
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->encode();

        $this->logger?->notice('------ Calculating error codes ------', ['class' => self::class]);

        $errorCorrectionBitString = $this->errorCorrectionCoder
            ->withVersion($this->version)
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->calculateErrorCorrection($encodedBitString);

        $this->logger?->notice('------ Assembling data and error codes ------', ['class' => self::class]);

        return $this->finalCodewordsAssembler
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->withVersion($this->version)
            ->assemble($encodedBitString, $errorCorrectionBitString);
    }
}
