<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrixCreator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\BitMatrixMasker;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer\DataCodewordPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\NonDataPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PatternPlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder\FormatInfoBuilder;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder\VersionInfoBuilder;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\DarkModule;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\InfoModulePlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\InfoModulePlacerInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Placer\Positions\InfoModulePositionFactoryInterface;
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
            FormatInfoBuilder::create($logger),
            VersionInfoBuilder::create($logger),
            InfoModulePlacerFactory::create(),
            InfoModulePositionFactory::create(),
            $logger
        );
    }

    private function __construct(
        private readonly BitMatrixCreatorInterface $bitMatrixCreator,
        private readonly PatternPlacerFactoryInterface $patternsPlacerFactory,
        private readonly DataCodewordPlacerInterface $codewordsPlacer,
        private readonly BitMatrixMaskerInterface $masker,
        private readonly FormatInfoBuilderInterface $formatInfoBuilder,
        private readonly VersionInfoBuilderInterface $versionInfoBuilder,
        private readonly InfoModulePlacerFactoryInterface $infoModulePlacerFactory,
        private readonly InfoModulePositionFactoryInterface $infoModulePositionFactory,
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

        $this->logger?->notice('------ Creating empty matrix ------', ['class' => self::class]);
        $nonDataPositions = NonDataPositions::empty();
        $matrix = $this->bitMatrixCreator
            ->withVersion($this->version)
            ->createEmptyMatrix();

        $this->logger?->notice("------ Placing function patterns ------", ['class' => self::class]);
        foreach (FunctionPatternType::all() as $functionPatternType) {
            $this->logger?->info("Placing {$functionPatternType->value}", ['class' => self::class]);
            $this->patternsPlacerFactory
                ->createPatternPlacer($functionPatternType)
                ->withVersion($this->version)
                ->place($matrix, $nonDataPositions);
        }

        foreach (InformationModule::all() as $infoModule) {
            $infoPositions = $this->infoModulePositionFactory->createInfoModulePositions($infoModule, $this->version);
            if ($infoPositions !== null) {
                $nonDataPositions->addPositions($infoPositions->positions());
            }
        }

        $this->logger?->notice("------ Placing data codewords ------", ['class' => self::class]);
        $this->codewordsPlacer
            ->withData($this->data)
            ->place($matrix, $nonDataPositions);

        $this->logger?->notice("------ Masking matrix ------", ['class' => self::class]);
        [$mask, $matrix] = $this->masker
            ->withFunctionPatternPositions($nonDataPositions)
            ->mask($matrix);


        $this->logger?->notice("------ Building information modules ------", ['class' => self::class]);
        $formatInfo = $this->formatInfoBuilder
            ->withMask($mask)
            ->withErrorCorrectionLevel($this->errorCorrectionLevel)
            ->build();

        $versionInfo = $this->versionInfoBuilder
            ->withVersion($this->version)
            ->build();

        $this->logger?->notice("------ Placing information modules ------", ['class' => self::class]);
        foreach (InformationModule::all() as $infoModule) {
            $this->logger?->info("Place {$infoModule->value}", ['class' => self::class]);
            $info = match ($infoModule) {
                InformationModule::TOP_RIGHT_VERSION_INFO,
                InformationModule::BOTTOM_LEFT_VERSION_INFO => $versionInfo,
                InformationModule::HORIZONTAL_FORMAT_INFO,
                InformationModule::VERTICAL_FORMAT_INFO => $formatInfo,
                InformationModule::DARK_MODULE => DarkModule::create(),
            };

            if ($info instanceof BitStringInterface) {
                $infoPlacer = $this->infoModulePlacerFactory->createInfoModulePlacer($infoModule, $this->version);
                if ($infoPlacer instanceof InfoModulePlacerInterface) {
                    $infoPlacer->withData($info)->place($matrix);
                }
            }
        }

        return $matrix;
    }
}
