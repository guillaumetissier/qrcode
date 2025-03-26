<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

class CodewordsAssemblerUnit implements CodewordsAssemblerInterface
{
    private ?int $dataOffset = null;

    private ?int $errorOffset = null;

    public function __construct(
        private readonly int $totalNumberOfCodewords,
        private readonly int $numberOfDataCodewords,
        private readonly int $numberEcCapacity,
    )
    {
    }

    public function getTotalNumberOfCodewords(): int
    {
        return $this->totalNumberOfCodewords;
    }

    public function getNumberOfDataCodewords(): int
    {
        return $this->numberOfDataCodewords;
    }

    public function getNumberOfErrorCorrectionCodewords(): int
    {
        return $this->totalNumberOfCodewords - $this->numberOfDataCodewords;
    }

    public function getNumberEcCapacity(): int
    {
        return $this->numberEcCapacity;
    }

    public function setDataOffset(int $dataOffset): self
    {
        $this->dataOffset = $dataOffset;

        return $this;
    }

    public function setErrorOffset(?int $errorOffset): self
    {
        $this->errorOffset = $errorOffset;

        return $this;
    }

    public function assemble(string $dataCodewords, string $errorCodewords): string
    {
        return substr($dataCodewords, $this->dataOffset, $this->numberOfDataCodewords) .
            substr($errorCodewords, $this->errorOffset, $this->getNumberOfErrorCorrectionCodewords());
    }
}
