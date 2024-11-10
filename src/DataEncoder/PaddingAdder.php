<?php

namespace ThePhpGuild\QrCode\DataEncoder;

class PaddingAdder
{
    private ?Mode $mode = null;
    private ?int $version = null;
    private ?string $data = null;

    public function setMode(Mode $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function addPadding(): string
    {
        $lengthBits = $this->getLengthBits();
        $binaryData = $this->mode->getIndicator() . $lengthBits . $this->data;

        // Ajout de bits de fin (terminator)
        $binaryData = str_pad($binaryData, $this->getTotalBits(), '0');

        // Ajout des octets de remplissage si nécessaire
        while (strlen($binaryData) % 8 !== 0) {
            $binaryData .= '0';
        }

        // Ajouter les octets de remplissage pour atteindre la longueur nécessaire
        $paddingBytes = ['11101100', '00010001'];
        $i = 0;
        while (strlen($binaryData) < $this->getTotalBits()) {
            $binaryData .= $paddingBytes[$i % 2];
            $i++;
        }

        return $binaryData;
    }

    private function getLengthBits(): string
    {
        $dataLength = strlen($this->data);

        if ($this->version <= 9) {
            return match($this->mode) {
                Mode::NUMERIC => str_pad(decbin($dataLength), 10, '0', STR_PAD_LEFT),
                Mode::ALPHANUMERIC => str_pad(decbin($dataLength), 9, '0', STR_PAD_LEFT),
                Mode::BYTE => str_pad(decbin($dataLength), 8, '0', STR_PAD_LEFT)
            };
        }

        return str_pad(decbin($dataLength), 12, '0', STR_PAD_LEFT); // Simplification
    }

    private function getTotalBits(): int
    {
        // Obtenir le nombre total de bits pour la version et le niveau de correction
        // Simplification, on suppose version 1 avec un niveau faible de correction (26 octets)
        return 26 * 8;
    }
}