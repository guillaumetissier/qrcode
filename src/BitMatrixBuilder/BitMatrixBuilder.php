<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrixCreator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\BitMatrixMasker;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer\DataCodewordPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PatternPlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\FormatInfo;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\InfoModulePlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\VersionInfo;
use Guillaumetissier\QrCode\BitMatrixBuilderInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixBuilder implements BitMatrixBuilderInterface
{
    private ?Version $version = null;

    private ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    private ?BitStringInterface $data = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(
            BitMatrixCreator::create(),
            PatternPlacerFactory::create(),
            DataCodewordPlacer::create(),
            BitMatrixMasker::create($logger),
            InfoModulePlacerFactory::create(),
            $logger
        );
    }

    private function __construct(
        private readonly BitMatrixCreatorInterface $bitMatrixCreator,
        private readonly PatternPlacerFactoryInterface $patternsPlacerFactory,
        private readonly DataCodewordPlacerInterface $codewordsPlacer,
        private readonly BitMatrixMaskerInterface $masker,
        private readonly InfoModulePlacerFactoryInterface $infoModulePlacerFactory,
        private readonly ?IOLoggerInterface $logger = null
    ) {
    }

    private function __clone()
    {
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

    public function withData(BitStringInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @throws MissingInfoException
     */
    public function build(): BitMatrix
    {
        if ($this->version === null) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        if ($this->errorCorrectionLevel === null) {
            throw MissingInfoException::missingInfo('errorCorrectionLevel', self::class);
        }

        if ($this->data === null) {
            throw MissingInfoException::missingInfo('data', self::class);
        }

        $this->logger?->notice('****** Create empty matrix ******', ['class' => self::class]);
        $functionPatternPositions = FunctionPatternPositions::empty();
        $matrix = $this->bitMatrixCreator
            ->withVersion($this->version)
            ->createEmptyMatrix();

        $this->logger?->notice("****** Place function patterns ******", ['class' => self::class]);
        foreach (FunctionPatternType::all() as $functionPatternType) {
            $this->logger?->info("Place {$functionPatternType->value}", ['class' => self::class]);
            $this->patternsPlacerFactory
                ->createPatternPlacer($functionPatternType)
                ->withVersion($this->version)
                ->place($matrix, $functionPatternPositions);
        }

        $this->logger?->notice("****** Place data codewords ******", ['class' => self::class]);
        $this->codewordsPlacer
            ->withData($this->data)
            ->place($matrix, $functionPatternPositions);

        $this->logger?->notice("****** Mask matrix ******", ['class' => self::class]);
        [$mask, $matrix] = $this->masker
            ->withFunctionPatternPositions($functionPatternPositions)
            ->mask($matrix);

        $this->logger?->notice("****** Place information modules ******", ['class' => self::class]);
        $versionInfo = VersionInfo::create($this->version)
            ->toBitString();
        $formatInfo = FormatInfo::create($this->logger)
            ->withMask($mask)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->bitString();

        foreach (InformationModule::all() as $infoModule) {
            $this->logger?->info("Place {$infoModule->value}", ['class' => self::class]);
            $info = match ($infoModule) {
                InformationModule::TOP_RIGHT_VERSION_INFO,
                InformationModule::BOTTOM_LEFT_VERSION_INFO => $versionInfo,
                InformationModule::HORIZONTAL_FORMAT_INFO,
                InformationModule::VERTICAL_FORMAT_INFO => $formatInfo,
            };
            if ($info instanceof BitStringInterface) {
                $this->infoModulePlacerFactory
                    ->createInfoModulePlacer($infoModule)
                    ->withData($info)
                    ->place($matrix);
            }
        }

        return $matrix;
    }
}
