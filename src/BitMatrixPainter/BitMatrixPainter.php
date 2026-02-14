<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixPainter;

use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixPainter\Canvas\CanvasFactory;
use Guillaumetissier\QrCode\BitMatrixPainter\Painter\PainterFactory;
use Guillaumetissier\QrCode\Common\OutputOptionsDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Exception\UnhandledFileTypeException;
use Guillaumetissier\QrCode\BitMatrixPainterInterface;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixPainter implements BitMatrixPainterInterface
{
    use OutputOptionsDependentTrait;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            CanvasFactory::create(),
            PainterFactory::create(),
            $logger
        );
    }

    private function __construct(
        private readonly CanvasFactoryInterface $canvasFactory,
        private readonly PainterFactoryInterface $painterFactory,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    private function __clone()
    {
    }

    /**
     * @param BitMatrix $matrix
     * @return void
     * @throws MissingInfoException
     */
    public function paint(BitMatrix $matrix): void
    {
        $outputOptions = $this->outputOptions();

        $this->logger?->notice('------ Creating canvas ------', ['class' => self::class]);

        $fileType = $outputOptions->fileType();
        $canvas = $this->canvasFactory
            ->createCanvas($fileType, $matrix->size(true) * $outputOptions->scale());

        $this->logger?->notice('------ Painting matrix ------', ['class' => self::class]);

        $this->painterFactory
            ->createPainter($fileType)
            ->withCanvas($canvas)
            ->withScale($outputOptions->scale())
            ->paint($matrix);

        $canvas
            ->withOutputOptions($outputOptions)
            ->output();
    }
}
