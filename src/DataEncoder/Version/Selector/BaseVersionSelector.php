<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\Logger\LevelFilteredLogger;

class BaseVersionSelector implements VersionSelectorInterface
{
    protected array $capacityTable = [];

    protected function __construct(
        private readonly LevelFilteredLogger $logger,
        array $capacityTable
    ) {
        $this->capacityTable = $capacityTable;
    }

    public function selectVersion($dataLength): Version
    {
        $this->logger->debug("Select version number. Data length = {$dataLength}.");

        foreach ($this->capacityTable as $version => $capacity) {
            if ($dataLength <= $capacity) {
                $this->logger->debug("Output >> {$version}");

                return Version::from($version);
            }
        }

        $this->logger->error("Data too voluminous. It cannot be encoded.");

        throw new \Exception("Data too voluminous. It cannot be encoded.");
    }
}