<?php

namespace ThePhpGuild\QrCode\DataEncoder\Version\Selector;

use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;

class BaseVersionSelector implements VersionSelectorInterface
{
    protected array $capacityTable = [];

    protected function __construct(
        readonly private VersionFromIntConverter $converter,
        array $capacityTable
    ) {
        $this->capacityTable = $capacityTable;
    }

    public function selectVersion($dataLength): Version
    {
        foreach ($this->capacityTable as $version => $capacity) {
            if ($dataLength <= $capacity) {
                return $this->converter->fromInt($version);
            }
        }

        throw new \Exception("Données trop volumineuses pour être encodées dans un QR Code.");
    }
}