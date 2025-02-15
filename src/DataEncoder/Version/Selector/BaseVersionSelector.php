<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;

class BaseVersionSelector implements VersionSelectorInterface
{
    protected array $capacityTable = [];

    protected function __construct(array $capacityTable)
    {
        $this->capacityTable = $capacityTable;
    }

    public function selectVersion($dataLength): Version
    {
        foreach ($this->capacityTable as $version => $capacity) {
            if ($dataLength <= $capacity) {
                return Version::fromInt($version);
            }
        }

        throw new \Exception("Données trop volumineuses pour être encodées dans un QR Code.");
    }
}