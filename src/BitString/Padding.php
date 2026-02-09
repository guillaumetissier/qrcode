<?php

namespace Guillaumetissier\QrCode\BitString;

use Guillaumetissier\BitString\BitString;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class Padding implements PaddingInterface
{
    private ?int $dataBitCount = null;

    private ?int $totalCodewords = null;

    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new self($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    private function __clone()
    {
    }

    public function withDataBitCount(int $dataBitCount): self
    {
        $this->dataBitCount = $dataBitCount;

        return $this;
    }

    public function withTotalCodewords(int $totalCodewords): self
    {
        $this->totalCodewords = $totalCodewords;

        return $this;
    }

    /**
     * @return BitStringInterface
     * @throws MissingInfoException
     */
    public function bitString(): BitStringInterface
    {
        if ($this->dataBitCount === null) {
            throw MissingInfoException::missingInfo('dataBitCount', self::class);
        }

        if ($this->totalCodewords === null) {
            throw MissingInfoException::missingInfo('totalCodewords', self::class);
        }

        $this->logger?->input(
            "Data bit count = {$this->dataBitCount}, Total codewords = {$this->totalCodewords}",
            ['class' => self::class]
        );

        $padding = BitString::zeros((8 - $this->dataBitCount % 8) % 8);
        $codewordCount = (int)(($this->dataBitCount + $padding->bitCount()) / 8);

        if ($this->totalCodewords > $codewordCount) {
            $paddingCodewords = [BitString::fromString('11101100'), BitString::fromString('00010001')];
            for ($i = 0; $i < ($this->totalCodewords - $codewordCount); $i++) {
                $padding->append($paddingCodewords[$i % 2]);
            }
        }

        $this->logger?->output("Padding = {$padding}", ['class' => self::class]);

        return $padding;
    }
}
