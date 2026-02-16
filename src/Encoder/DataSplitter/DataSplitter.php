<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataSplitter;

use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\ErrorCorrectionLevelDependentTrait;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Common\VersionDependentTrait;
use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\CodewordBlocksFactory;
use Guillaumetissier\QrCode\Encoder\DataSplitter\CodewordBlocks\ErrorCorrectionCodePerBlockInterface;
use Guillaumetissier\QrCode\Encoder\DataSplitterInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class DataSplitter implements DataSplitterInterface
{
    use VersionDependentTrait;
    use ErrorCorrectionLevelDependentTrait;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self(CodewordBlocksFactory::create($logger), $logger);
    }

    private function __construct(
        private readonly CodewordBlocksFactoryInterface $codewordBlocksFactory,
        private readonly ?IOLoggerInterface $logger = null,
    ) {
    }

    private function __clone()
    {
    }

    /**
     * Splits encoded data codewords into blocks as defined in ISO/IEC 18004 Table 13-22
     *
     * @return DataBlockInterface[]
     * @throws MissingInfoException
     */
    public function split(BitStringInterface $dataCodewords): array
    {
        $offset = 0;
        $dataBlocks = [];
        $version = $this->version();
        $errorCorrectionLevel = $this->errorCorrectionLevel();
        $blocks = $this->codewordBlocksFactory
            ->getCodewordBlocks($version)
            ->withErrorCorrectionLevel($errorCorrectionLevel)
            ->getBlocks();

        /**
         * @var int $numBlocks
         * @var ErrorCorrectionCodePerBlockInterface $block
         */
        foreach ($blocks as [$numBlocks, $block]) {
            $blockSizeBits = $block->numDataCodewords() * 8;

            for ($i = 0; $i < $numBlocks; $i++) {
                $dataCodeword = $dataCodewords->extract($offset, $blockSizeBits);
                $dataBlocks[] = new DataBlock($dataCodeword, $block->numErrorCorrectionCodewords());
                $this->logger?->debug(
                    "Data block = " . PHP_EOL . BitStringFormatter::format($dataCodeword),
                    ['class' => self::class]
                );
                $offset += $blockSizeBits;
            }
        }

        return $dataBlocks;
    }
}
