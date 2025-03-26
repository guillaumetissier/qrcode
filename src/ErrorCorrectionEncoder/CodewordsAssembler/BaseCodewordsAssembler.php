<?php

namespace ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler;

use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class BaseCodewordsAssembler implements CodewordsAssemblerInterface
{
    protected ?ErrorCorrectionLevel $errorCorrectionLevel = null;

    public function __construct(private readonly array $blocks, private readonly IOLoggerInterface $logger)
    {
    }

    public function setErrorCorrectionLevel(?ErrorCorrectionLevel $errorCorrectionLevel): self
    {
        $this->errorCorrectionLevel = $errorCorrectionLevel;

        return $this;
    }

    public function getTotalNumberOfCodewords(): int
    {
        $blocks = $this->blocks[$this->errorCorrectionLevel->value];
        $totalNumberOfCodewords = 0;
        foreach ($blocks as $numAndBlocks) {
            /** @var CodewordsAssemblerUnit $block */
            [$numBlocks, $block] = $numAndBlocks;
            $totalNumberOfCodewords += $numBlocks * $block->getTotalNumberOfCodewords();
        }

        return $totalNumberOfCodewords;
    }

    public function getNumberOfDataCodewords(): int
    {
        $blocks = $this->blocks[$this->errorCorrectionLevel->value];
        $totalNumberOfDataCodewords = 0;
        foreach ($blocks as $numAndBlocks) {
            /** @var CodewordsAssemblerUnit $block */
            [$numBlocks, $block] = $numAndBlocks;
            $totalNumberOfDataCodewords += $numBlocks * $block->getNumberOfDataCodewords();
        }

        return $totalNumberOfDataCodewords;
    }

    public function getNumberOfErrorCorrectionCodewords(): int
    {
        $blocks = $this->blocks[$this->errorCorrectionLevel->value];
        $numberOfEcCodewords = 0;
        foreach ($blocks as $numAndBlocks) {
            /** @var CodewordsAssemblerUnit $block */
            [$numBlocks, $block] = $numAndBlocks;
            $numberOfEcCodewords += $numBlocks * $block->getNumberOfErrorCorrectionCodewords();
        }

        return $numberOfEcCodewords;
    }

    public function assemble(string $dataCodewords, string $errorCodewords): string
    {
        $this->logger->input("ECL = {$this->errorCorrectionLevel->value}", ['class' => static::class]);

        $blocks = $this->blocks[$this->errorCorrectionLevel->value];
        $assembled = '';
        $dataOffset = 0;
        $errorOffset = 0;
        foreach ($blocks as $numAndBlocks) {
            /** @var CodewordsAssemblerUnit $block */
            [$numBlocks, $block] = $numAndBlocks;
            for ($i = 0; $i < $numBlocks; $i++) {
                $assembled .= $block
                    ->setDataOffset($dataOffset)
                    ->setErrorOffset($errorOffset)
                    ->assemble($dataCodewords, $errorCodewords);
                $dataOffset += $block->getNumberOfDataCodewords();
                $errorOffset += $block->getNumberOfErrorCorrectionCodewords();
            }
        }

        $this->logger->output("Assembled = $assembled");

        return $assembled;
    }
}
