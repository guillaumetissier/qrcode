<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

class BaseCodewordBlocks implements CodewordBlocksInterface
{
    use ErrorCorrectionLevelDependentTrait;

    /**
     * @param array<string, list<array{int, ErrorCorrectionCodePerBlock}>> $blocks
     */
    public function __construct(private readonly array $blocks)
    {
    }

    /**
     * @return list<array{int, ErrorCorrectionCodePerBlock}>
     * @throws MissingInfoException
     */
    public function getBlocks(): array
    {
        return $this->blocks[$this->errorCorrectionLevel()->value];
    }
}
