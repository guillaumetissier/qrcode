<?php

namespace ThePhpGuild\Qrcode;

use ThePhpGuild\Qrcode\DataEncoder\DataEncoder;
use ThePhpGuild\Qrcode\DataEncoder\Encoder\EncoderFactory;
use ThePhpGuild\Qrcode\DataEncoder\ModeResolver;
use ThePhpGuild\QrCode\DataEncoder\PaddingAdder;
use ThePhpGuild\Qrcode\Matrix\MatrixBuilder;
use ThePhpGuild\Qrcode\Encoder\ReedSolomonEncoder;
use ThePhpGuild\Qrcode\Encoder\ReedSalomonEncoder\ErrorCorrectionLevel;
use ThePhpGuild\Qrcode\Encoder\ReedSalomonEncoder\GalloisField;
use ThePhpGuild\Qrcode\MatrixRenderer\FileType;
use ThePhpGuild\Qrcode\MatrixRenderer\MatrixRendererFactory;

class QRCodeGenerator
{
    static private ?QRCodeGenerator $Generator = null;
    private string $data;

    /* configuration parameters */
    private ErrorCorrectionLevel $errorCorrectionLevel = ErrorCorrectionLevel::LOW;
    private FileType $fileType = FileType::PNG;

    public static function getQrCodeGenerator(): self
    {
        if (!self::$Generator) {
            self::$Generator = new QRCodeGenerator(
                new DataEncoder(new ModeResolver(), new EncoderFactory(), new PaddingAdder()),
                new ReedSolomonEncoder(new GalloisField()),
                new MatrixBuilder(),
                new MatrixRendererFactory()
            );
        }
        return self::$Generator;
    }

    public function __construct(
        private readonly DataEncoder $dataEncoder,
        private readonly ReedSolomonEncoder $reedSolomonEncoder,
        private readonly MatrixBuilder $matrixBuilder,
        private readonly MatrixRendererFactory $matrixRendererFactory
    )
    {
    }

    public function setErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function setFileType(FileType $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function generate()
    {
        $encodedData = $this->dataEncoder
            ->setData($this->data)
            ->setVersion(1)
            ->encode();

        $dataWithErrorCorrection = $this->reedSolomonEncoder
            ->encode($encodedData, 12);

        $matrix = $this->matrixBuilder
            ->build();

        return $this->matrixRendererFactory
            ->getRenderer($this->fileType)
            ->setMatrix($matrix)
            ->render();
    }
}

