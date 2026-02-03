<?php

namespace Guillaumetissier\QrCode\BitMatrixBuilder;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrix;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixCreator\BitMatrixCreator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\BitMatrixMasker;
use Guillaumetissier\QrCode\BitMatrixBuilder\DataCodewordPlacer\DataCodewordPlacer;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\FunctionPatternPositions;
use Guillaumetissier\QrCode\BitMatrixBuilder\FunctionPatterns\Placer\PatternPlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\InfoModulePlacerFactory;
use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\VersionInfo;
use Guillaumetissier\QrCode\BitMatrixBuilderInterface;
use Guillaumetissier\QrCode\Enums\FunctionPatternType;
use Guillaumetissier\QrCode\Enums\InformationModule;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingParameter;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class BitMatrixBuilder implements BitMatrixBuilderInterface
{
    private ?Version $version = null;

    private ?BitStringInterface $data = null;

    public static function create(?IOLoggerInterface $IOLogger = null): self
    {
        return new self(
            BitMatrixCreator::create(),
            PatternPlacerFactory::create(),
            DataCodewordPlacer::create(),
            BitMatrixMasker::create($IOLogger),
            InfoModulePlacerFactory::create()
        );
    }

    private function __construct(
        private readonly BitMatrixCreatorInterface $bitMatrixCreator,
        private readonly PatternPlacerFactoryInterface $patternsPlacerFactory,
        private readonly DataCodewordPlacerInterface $codewordsPlacer,
        private readonly BitMatrixMaskerInterface $masker,
        private readonly InfoModulePlacerFactoryInterface $infoModulePlacerFactory,
        private readonly ?IOLoggerInterface $IOLogger = null
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

    public function withData(BitStringInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @throws MissingParameter
     */
    public function build(): BitMatrix
    {
        if ($this->version === null) {
            throw MissingParameter::missingParameter('version', self::class);
        }

        if ($this->data === null) {
            throw MissingParameter::missingParameter('data', self::class);
        }

        $this->IOLogger?->info('Creating empty matrix');
        $functionPatternPositions = new FunctionPatternPositions();
        $matrix = $this->bitMatrixCreator
            ->withVersion($this->version)
            ->createEmptyMatrix();

        $this->IOLogger?->info("Placing function patterns");
        foreach (FunctionPatternType::all() as $functionPatternType) {
            $this->IOLogger?->info("Placing {$functionPatternType->value}");
            $this->patternsPlacerFactory
                ->createPatternPlacer($functionPatternType)
                ->withVersion($this->version)
                ->place($matrix, $functionPatternPositions);
        }

        $this->IOLogger?->info("Placing data codewords");
        $this->codewordsPlacer
            ->withData($this->data)
            ->place($matrix);

        $this->IOLogger?->info("Masking matrix");
        $matrix = $this->masker
            ->withFunctionPatternPositions($functionPatternPositions)
            ->mask($matrix);

        $this->IOLogger?->info("Placing information modules");
        $versionInfo = VersionInfo::create($this->version)->toBitString();
        $formatInfo = '';
        foreach (InformationModule::all() as $infoModule) {
            $this->IOLogger?->info("Placing {$infoModule->value}");
            $this->infoModulePlacerFactory
                ->createInfoModulePlacer($infoModule)
                ->withData(match ($infoModule) {
                    InformationModule::TOP_RIGHT_VERSION_INFO,
                    InformationModule::BOTTOM_LEFT_VERSION_INFO => $versionInfo,
                    InformationModule::HORIZONTAL_FORMAT_INFO,
                    InformationModule::VERTICAL_FORMAT_INFO => $formatInfo,
                })
                ->place($matrix);
        }

        return $matrix;
    }
}
