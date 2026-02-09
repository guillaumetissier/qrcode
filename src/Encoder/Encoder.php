<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Mode\ModeDetector;
use Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector\VersionSelectorFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataEncoder;
use Guillaumetissier\QrCode\Encoder\ErrorCorrectionCalculator\ErrorCorrectionCalculator;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\FinalCodewordsAssembler;
use Guillaumetissier\QrCode\EncoderInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class Encoder implements EncoderInterface
{
    private ?string $data = null;

    private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::MEDIUM;

    private ?Version $version = null;

    private ?Mode $mode = null;

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

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->dataEncoder->withErrorCorrectionLevel($errorCorrectionLevel);

        return $this;
    }

    public function mode(): Mode
    {
        if ($this->mode === null) {
            throw MissingInfoException::wasNotComputed("mode", self::class);
        }

        return $this->mode;
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
        if ($this->data === null) {
            throw MissingInfoException::missingInfo("data", self::class);
        }

        $this->logger?->notice('****** Detecting mode ******', ['class' => self::class]);

        $this->mode = $this->modeDetector->withData($this->data)->detect();

        $this->logger?->notice('****** Detecting version ******', ['class' => self::class]);

        $this->version = $this->versionSelectorFactory
            ->getVersionSelector($this->mode, $this->errorCorrectionLevel)
            ->selectVersion(strlen($this->data));

        $this->logger?->notice('****** Encode data ******', ['class' => self::class]);

        $encodedBitString = $this->dataEncoder
            ->withData($this->data)
            ->withMode($this->mode)
            ->withVersion($this->version)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->encode();

        $this->logger?->notice('****** Calculate error codes ******', ['class' => self::class]);

        $errorCorrectionBitString = $this->errorCorrectionCoder
            ->withVersion($this->version)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->calculateErrorCorrection($encodedBitString);

        $this->logger?->notice('****** Assemble data and error codes ******', ['class' => self::class]);

        return $this->finalCodewordsAssembler
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->withVersion($this->version)
            ->assemble($encodedBitString, $errorCorrectionBitString);
    }
}
