<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Encoder\DataAssembler;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Encoder\DataSplitter\DataBlockInterface;
use Guillaumetissier\QrCode\Encoder\DataAssemblerInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

/**
 * ISO/IEC 18004:2000(E)
 * 8.6 Constructing the final message codeword sequence, p45-46
 */
final class DataAssembler implements DataAssemblerInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    /**
     * @throws MissingInfoException
     */
    /**
     * @param DataBlockInterface[] $dataBlocks
     * @param BitStringInterface[] $ecBlocks
     */
    public function assemble(array $dataBlocks, array $ecBlocks): BitStringInterface
    {
        $assembled = BitString::empty();

        // Interleave data
        $maxDataCodewords = max(array_map(fn($block) => $block->data()->bitCount() / 8, $dataBlocks));

        for ($col = 0; $col < $maxDataCodewords; $col++) {
            foreach ($dataBlocks as $dataBlock) {
                $offset = $col * 8;
                if ($offset < $dataBlock->data()->bitCount()) {
                    $assembled->append($dataBlock->data()->extract($offset, 8));
                }
            }
        }

        // Interleave EC
        $maxEcCodewords = max(array_map(fn($block) => $block->bitCount() / 8, $ecBlocks));

        for ($col = 0; $col < $maxEcCodewords; $col++) {
            foreach ($ecBlocks as $ecBlock) {
                $offset = $col * 8;
                if ($offset < $ecBlock->bitCount()) {
                    $assembled->append($ecBlock->extract($offset, 8));
                }
            }
        }

        $this->logger?->output(
            "Assembled blocks: " . PHP_EOL . BitStringFormatter::format($assembled),
            ['class' => self::class]
        );

        return BitStringImmutable::fromString($assembled->toString());
    }
}
