<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\QrCode\BitMatrixPainter\BitMatrixPainter;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Encoder\Encoder;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use Guillaumetissier\QrCode\Logger\LevelFilteredLogger;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixBuilder;
use Psr\Log\LoggerInterface;

final class QrCodeGenerator
{
    use ErrorCorrectionLevelDependentTrait;

    private OutputOptions $outputOptions;

    private string $data;

    public static function create(?LoggerInterface $logger = null, ?string $logLevel = null): self
    {
        $levelFilteredLogger = new LevelFilteredLogger($logger);
        if ($logLevel) {
            $levelFilteredLogger->setLogLevel($logLevel);
        }

        return new self(
            Encoder::create($levelFilteredLogger),
            BitMatrixBuilder::create($levelFilteredLogger),
            BitMatrixPainter::create($levelFilteredLogger),
            $levelFilteredLogger
        );
    }

    private function __construct(
        private readonly EncoderInterface $encoder,
        private readonly BitMatrixBuilderInterface $matrixBuilder,
        private readonly BitMatrixPainterInterface $matrixRenderer,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
        $this->withErrorCorrectionLevel(ErrorCorrectionLevel::LOW);
    }

    private function __clone()
    {
    }

    public function withOutputOptions(OutputOptions $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function generate(): void
    {
        $errorCorrectionLevel = $this->errorCorrectionLevel();

        $this->logger?->notice('###### Encode data ######', ['class' => self::class]);

        $encoder = $this->encoder
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->withData($this->data);

        $encodedData = $encoder->encode();
        $version = $encoder->version();

        $this->logger?->notice('###### Building QR code matrix ######', ['class' => self::class]);

        $matrix = $this->matrixBuilder
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->withVersion($version)
            ->withData($encodedData)
            ->build();

        $this->logger?->notice('###### Painting QR code matrix ######', ['class' => self::class]);

        $this->matrixRenderer
            ->setOutputOptions($this->outputOptions)
            ->paint($matrix);

        $this->logger?->notice('###### QR code was generated ######', ['class' => self::class]);
    }
}
