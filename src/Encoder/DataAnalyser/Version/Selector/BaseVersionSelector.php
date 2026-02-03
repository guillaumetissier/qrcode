<?php

namespace Guillaumetissier\QrCode\Encoder\DataAnalyser\Version\Selector;

use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\DataTooVoluminous;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

class BaseVersionSelector implements VersionSelectorInterface
{
    /**
     * @var array<int, int> $capacityTable
     */
    protected array $capacityTable = [];

    /**
     * @param array<int, int> $capacityTable
     */
    protected function __construct(array $capacityTable, private readonly ?IOLoggerInterface $logger = null)
    {
        $this->capacityTable = $capacityTable;
    }

    public function selectVersion(int $dataLength): Version
    {
        $this->logger?->input("Data length = {$dataLength}.", ['class' => self::class]);

        foreach ($this->capacityTable as $version => $capacity) {
            if ($dataLength <= $capacity) {
                $this->logger?->output("Version = {$version}", ['class' => self::class]);

                return Version::from($version);
            }
        }

        throw new DataTooVoluminous();
    }
}
