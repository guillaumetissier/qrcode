<?php

namespace ThePhpGuild\QrCode\Step1DataAnalyser\Version\Selector;

use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Exception\DataTooVoluminous;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class BaseVersionSelector implements VersionSelectorInterface
{
    protected array $capacityTable = [];

    protected function __construct(private readonly IOLoggerInterface $logger, array $capacityTable)
    {
        $this->capacityTable = $capacityTable;
    }

    public function selectVersion($dataLength): Version
    {
        $this->logger->input("Data length = {$dataLength}.", ['class' => static::class]);

        foreach ($this->capacityTable as $version => $capacity) {
            if ($dataLength <= $capacity) {
                $this->logger->output("Version = {$version}", ['class' => static::class]);

                return Version::from($version);
            }
        }

        throw new DataTooVoluminous();
    }
}