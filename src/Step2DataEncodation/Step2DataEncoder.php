<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

use ThePhpGuild\QrCode\BitsString\CharCountIndicator;
use ThePhpGuild\QrCode\BitsString\DataBits;
use ThePhpGuild\QrCode\BitsString\ModeIndicator;
use ThePhpGuild\QrCode\BitsString\Terminator;
use ThePhpGuild\QrCode\Enums\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Enums\Mode;
use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;
use ThePhpGuild\QrCode\Step2DataEncodation\Encoder\Factory as EncoderFactory;

class Step2DataEncoder
{
    private ?string $data = null;
    private ?Mode $mode = null;
    private ?Version $version = null;
    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function __construct(
        private readonly EncoderFactory       $encoderFactory,
        private readonly ModeIndicator        $modeIndicator,
        private readonly CharCountIndicator   $charCountIndicator,
        private readonly Terminator           $terminator,
        private readonly DataCodewordsCounter $dataCodewordsCounter,
        private readonly IOLoggerInterface    $logger
    )
    {
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function encode(): DataBits
    {
        $dataBits = new DataBits();
        $this->appendModeIndicator($dataBits);
        $this->appendCharCountIndicator($dataBits);
        $this->appendEncodedData($dataBits);
        $this->appendTerminator($dataBits);
        $this->appendPadding($dataBits);

        return $dataBits;
    }

    private function appendModeIndicator(DataBits $dataBits): void
    {
        $modeIndicator = $this->modeIndicator->setMode($this->mode);

        $this->logger->info("Mode indicator: {$modeIndicator}", ['class' => self::class]);

        $dataBits->append($modeIndicator);
    }

    private function appendCharCountIndicator(DataBits $dataBits): void
    {
        $charCountIndicator = $this->charCountIndicator
            ->setMode($this->mode)
            ->setVersion($this->version)
            ->setCharCount(strlen($this->data));

        $this->logger->info("Char Count indicator: {$charCountIndicator}", ['class' => self::class]);

        $dataBits->append($charCountIndicator);
    }

    private function appendEncodedData(DataBits $dataBits): void
    {
        $encodedData = $this->encoderFactory->getEncoder($this->mode)->setData($this->data)->encode();

        $this->logger->info("Encoded data: {$encodedData}", ['class' => self::class]);

        $dataBits->append($encodedData);
    }

    private function appendTerminator(DataBits $dataBits): void
    {
        $this->logger->info("Terminator: {$this->terminator}", ['class' => self::class]);

        $dataBits->append($this->terminator);
    }

    private function appendPadding(DataBits $dataBits): void
    {
        $dataBits->padLastCodeword();
        $totalCodewords = $this->dataCodewordsCounter
            ->setErrorCorrectionLevel($this->errorCorrectionLevel)
            ->setVersion($this->version)
            ->count();

        $padding = '';
        if ($totalCodewords > $dataBits->getCodewordsCount()) {
            $paddingCodewords = ['11101100', '00010001'];
            for ($i = 0; $i < ($totalCodewords - $dataBits->getCodewordsCount()); $i++) {
                $padding .= $paddingCodewords[$i % 2];
            }
        }

        $this->logger->info("Padding codewords: {$padding}", ['class' => self::class]);

        $dataBits->append($padding);
    }
}
