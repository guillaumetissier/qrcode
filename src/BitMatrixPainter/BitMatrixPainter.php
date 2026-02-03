<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasFactory;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\PainterFactory;
use Guillaumetissier\QrCode\Commands\Output\OutputOptions;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;
use Guillaumetissier\QrCode\BitMatrixPainterInterface;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixPainter implements BitMatrixPainterInterface
{
    private ?OutputOptions $outputOptions = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            CanvasFactory::create(),
            PainterFactory::create(),
            $logger
        );
    }

    public function __construct(
        private readonly CanvasFactoryInterface $canvasFactory,
        private readonly PainterFactoryInterface $painterFactory,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    public function setOutputOptions(OutputOptions $outputOptions): self
    {
        $this->outputOptions = $outputOptions;

        return $this;
    }

    /**
     * @throws UnhandledFileTypeException
     */
    public function paint(BitMatrix $matrix): void
    {
        $this->logger?->info('Paint matrix', ['class' => self::class]);

        if ($this->outputOptions === null) {
            throw MissingInfoException::missingInfo('outputOptions', self::class);
        }

        $fileType = $this->outputOptions->fileType();

        $canvas = $this->canvasFactory
            ->createCanvas($fileType, $matrix->size() * $this->outputOptions->scale());

        $this->painterFactory
            ->createPainter($fileType)
            ->withCanvas($canvas)
            ->withScale($this->outputOptions->scale())
            ->paint($matrix);

        $canvas->output($this->outputOptions);
    }
}
