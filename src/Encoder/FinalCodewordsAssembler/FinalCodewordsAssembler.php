<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks\CodewordBlocksFactory;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssemblerInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class FinalCodewordsAssembler implements FinalCodewordsAssemblerInterface
{
    use ErrorCorrectionLevelDependentTrait;
    use VersionDependentTrait;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(CodewordBlocksFactory::create($logger), $logger);
    }

    private function __construct(
        private readonly CodewordBlocksFactoryInterface $factory,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    /**
     * @throws MissingInfoException
     */
    public function assemble(BitStringInterface $dataCodewords, BitStringInterface $errorCodewords): BitStringImmutable
    {
        $errorCorrectionLevel = $this->errorCorrectionLevel();
        $version = $this->version();

        $this->logger?->input("ECL = {$errorCorrectionLevel->value}", ['class' => self::class]);

        $assembled = BitString::empty();
        $dataOffset = 0;
        $errorOffset = 0;
        $codewordBlocks = $this->factory->getCodewordBlocks($version);

        foreach ($codewordBlocks->withErrorCorrectionLevel($errorCorrectionLevel)->getBlocks() as $numAndBlocks) {
            [$numBlocks, $block] = $numAndBlocks;
            $dataCodewordBlockSize = $block->numDataCodewords() * 8;
            $ecCodewordBlockSize = $block->numErrorCorrectionCodewords() * 8;

            for ($i = 0; $i < $numBlocks; $i++) {
                $assembled->append($dataCodewords->extract($dataOffset, $dataCodewordBlockSize));
                $assembled->append($errorCodewords->extract($errorOffset, $ecCodewordBlockSize));
                $dataOffset += $dataCodewordBlockSize;
                $errorOffset += $ecCodewordBlockSize;
            }
        }

        $this->logger?->output("Assembled = $assembled", ['class' => self::class]);

        return BitStringImmutable::fromString($assembled->toString());
    }
}
