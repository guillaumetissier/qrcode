<?php

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingParameter;

class BaseCodewordBlocks implements CodewordBlocksInterface
{
    protected ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    /**
     * @param array<string, list<array{int, ErrorCorrectionCodePerBlock}>> $blocks
     */
    public function __construct(private readonly array $blocks)
    {
    }

    public function withErrorCorrectionLevel(ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    /**
     * @return list<array{int, ErrorCorrectionCodePerBlock}>
     * @throws MissingParameter
     */
    public function getBlocks(): array
    {
        if ($this->errorCorrectionLevel === null) {
            throw MissingParameter::missingParameter('errorCorrectionLevel', self::class);
        }

        return $this->blocks[$this->errorCorrectionLevel->value];
    }
}
