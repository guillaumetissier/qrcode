<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode;

use Guillaumetissier\QrCode\BitMatrixPainter\BitMatrixPainter;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Encoder\Encoder;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;
use Guillaumetissier\QrCode\Logger\LevelFilteredLogger;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixBuilder;
use Psr\Log\LoggerInterface;

final class QrCodeGenerator
{
    private OutputOptions $outputOptions;

    private string $data;

    private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::LOW;

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

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function generate(): void
    {
        $this->logger?->notice('###### Encode data ######', ['class' => self::class]);

        $encoder = $this->encoder
            ->withData($this->data)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel);

        $encodedData = $encoder->encode();
        $version = $encoder->version();

        $this->logger?->notice('###### Building QR code matrix ######', ['class' => self::class]);

        $matrix = $this->matrixBuilder
            ->withVersion($version)
            ->withData($encodedData)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->build();

        $this->logger?->notice('###### Painting QR code matrix ######', ['class' => self::class]);

        $this->matrixRenderer
            ->setOutputOptions($this->outputOptions)
            ->paint($matrix);

        $this->logger?->notice('###### QR code was generated ######', ['class' => self::class]);
    }
}
