<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Common\Helper\ClassNameHelper;
use Guillaumetissier\QrCode\Encoder\VersionSelectorFactoryInterface;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Enums\Mode;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class VersionSelectorFactory implements VersionSelectorFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    public function getVersionSelector(Mode $mode, ErrorCorrectionLevel $ecl): VersionSelectorInterface
    {
        $this->logger?->input("Mode = {$mode->value}, ECL = {$ecl->value}", ['class' => self::class]);

        $versionSelector = match ($mode) {
            Mode::ALPHANUMERIC => match ($ecl) {
                ErrorCorrectionLevel::LOW => new AlphanumericLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new AlphanumericMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new AlphanumericQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new AlphanumericHighVersionSelector($this->logger),
            },
            Mode::NUMERIC => match ($ecl) {
                ErrorCorrectionLevel::LOW => new NumericLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new NumericMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new NumericQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new NumericHighVersionSelector($this->logger),
            },
            Mode::BYTE => match ($ecl) {
                ErrorCorrectionLevel::LOW => new ByteLowVersionSelector($this->logger),
                ErrorCorrectionLevel::MEDIUM => new ByteMediumVersionSelector($this->logger),
                ErrorCorrectionLevel::QUARTILE => new ByteQuartileVersionSelector($this->logger),
                ErrorCorrectionLevel::HIGH => new ByteHighVersionSelector($this->logger),
            }
        };

        $this->logger?->output(
            "Version selector = " . ClassNameHelper::getClassName($versionSelector::class),
            ['class' => self::class]
        );

        return $versionSelector;
    }
}
