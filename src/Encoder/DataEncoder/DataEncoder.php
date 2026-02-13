<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataEncoder;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\QrCode\BitString\CharCountIndicator;
use Guillaumetissier\QrCode\BitString\CharCountIndicatorInterface;
use Guillaumetissier\QrCode\BitString\ModeIndicator;
use Guillaumetissier\QrCode\BitString\ModeIndicatorInterface;
use Guillaumetissier\QrCode\BitString\Padding;
use Guillaumetissier\QrCode\BitString\PaddingInterface;
use Guillaumetissier\QrCode\BitString\Terminator;
use Guillaumetissier\QrCode\BitString\TerminatorInterface;
use Guillaumetissier\QrCode\Common\DataDependentTrait;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Common\ModeDependentTrait;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Encoder\DataEncoder\DataCodewordsCounter\DataCodewordsCounterFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderFactory;
use Guillaumetissier\QrCode\Encoder\DataEncoderInterface;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class DataEncoder implements DataEncoderInterface
{
    use ErrorCorrectionLevelDependentTrait;
    use VersionDependentTrait;
    use ModeDependentTrait;
    use DataDependentTrait;

    private ?Mode $mode = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            DataCodewordsCounterFactory::create($logger),
            ModeEncoderFactory::create($logger),
            ModeIndicator::create($logger),
            CharCountIndicator::create($logger),
            Terminator::create(),
            Padding::create($logger),
            $logger
        );
    }

    private function __construct(
        private readonly DataCodewordsCounterFactoryInterface $dataCodewordsCounterFactory,
        private readonly ModeEncoderFactoryInterface $modeEncoderFactory,
        private readonly ModeIndicatorInterface $modeIndicator,
        private readonly CharCountIndicatorInterface $charCountIndicator,
        private readonly TerminatorInterface $terminator,
        private readonly PaddingInterface $padding,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    private function __clone()
    {
    }

    /**
     * @throws MissingInfoException
     */
    public function encode(): BitString
    {
        $errorCorrectionLevel = $this->errorCorrectionLevel();
        $version = $this->version();
        $mode = $this->mode();
        $data = $this->data();

        $dataBitString = BitString::empty();

        $this->logger?->info('Calculate total codewords', ['class' => self::class]);
        $totalCodewords = $this->dataCodewordsCounterFactory
            ->getDataCodewordsCounter($errorCorrectionLevel)
            ->withVersion($version)
            ->count();

        $this->logger?->info('Append mode Indicator', ['class' => self::class]);
        $dataBitString
            ->append($this->modeIndicator
                ->withMode($mode)
                ->bitString());

        $this->logger?->info('Append char counter indicator', ['class' => self::class]);
        $dataBitString
            ->append($this->charCountIndicator
                ->withVersion($version)
                ->withMode($mode)
                ->withData($data)
                ->bitString());

        $this->logger?->info('Append data', ['class' => self::class]);
        $dataBitString
            ->append($this->modeEncoderFactory
                ->getModeEncoder($mode)
                ->withData($data)
                ->encode());

        $this->logger?->info('Append terminator', ['class' => self::class]);
        $dataBitString->append($this->terminator->bitString());


        $this->logger?->info('Append padding', ['class' => self::class]);
        $dataBitString
            ->append($this->padding
                ->withDataBitCount($dataBitString->bitCount())
                ->withTotalCodewords($totalCodewords)
                ->bitString());

        return $dataBitString;
    }
}
