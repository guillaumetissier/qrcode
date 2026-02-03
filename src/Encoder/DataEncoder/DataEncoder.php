<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\BitString\CharCountIndicator;
use Guillaumetissier\QrCode\BitString\CharCountIndicatorInterface;
use Guillaumetissier\QrCode\BitString\ModeIndicator;
use Guillaumetissier\QrCode\BitString\ModeIndicatorInterface;
use Guillaumetissier\QrCode\BitString\Terminator;
use Guillaumetissier\QrCode\BitString\TerminatorInterface;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoderInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class DataEncoder implements DataEncoderInterface
{
    private ?string $data = null;

    private ?Mode $mode = null;

    private ?Version $version = null;

    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            ModeEncoderFactory::create($logger),
            ModeIndicator::create($logger),
            CharCountIndicator::create($logger),
            Terminator::create(),
            DataCodewordsCounterFactory::create(),
            $logger
        );
    }

    private function __construct(
        private readonly ModeEncoderFactoryInterface $modeEncoderFactory,
        private readonly ModeIndicatorInterface $modeIndicator,
        private readonly CharCountIndicatorInterface $charCountIndicator,
        private readonly TerminatorInterface $terminator,
        private readonly DataCodewordsCounterFactoryInterface $dataCodewordsCounterFactory,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    private function __clone()
    {
    }

    public function withData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function withMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function withVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function encode(): BitString
    {
        if (!is_string($this->data)) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        if (!$this->mode instanceof Mode) {
            throw MissingInfoException::missingInfo('mode', self::class);
        }

        if (!$this->version instanceof Version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        if (!$this->errorCorrectionLevel instanceof ErrorCorrectionLevel) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        $dataBitString = BitString::empty();

        $this->logger?->info('Append mode Indicator', ['class' => self::class]);
        $dataBitString
            ->append($this->modeIndicator
                ->withMode($this->mode)
                ->bitString());

        $this->logger?->info('Append char counter indicator', ['class' => self::class]);
        $dataBitString
            ->append($this->charCountIndicator
                ->withMode($this->mode)
                ->withVersion($this->version)
                ->withCharCount(strlen($this->data))
                ->bitString());

        $this->logger?->info('Append data', ['class' => self::class]);
        $dataBitString
            ->append($this->modeEncoderFactory
                ->getModeEncoder($this->mode)
                ->withData($this->data)
                ->encode());

        $this->logger?->info('Append terminator', ['class' => self::class]);
        $dataBitString->append($this->terminator->bitString());

        $totalCodewords = $this->dataCodewordsCounterFactory
            ->getDataCodewordsCounter($this->errorCorrectionLevel)
            ->withVersion($this->version)
            ->count();

        $this->logger?->info('Append padding', ['class' => self::class]);
        $this->appendPadding($dataBitString, $totalCodewords);

        return $dataBitString;
    }

    private function appendPadding(BitString $dataBitString, int $totalCodewords): void
    {
        $bitCount = $dataBitString->bitCount();
        $dataBitString->append(BitString::zeros((8 - $bitCount % 8)));
        $codewordCount = $dataBitString->bitCount() / 8;

        if ($totalCodewords > $codewordCount) {
            $paddingCodewords = [BitString::fromString('11101100'), BitString::fromString('00010001')];
            for ($i = 0; $i < ($totalCodewords - $codewordCount); $i++) {
                $dataBitString->append($paddingCodewords[$i % 2]);
            }
        }
    }
}
