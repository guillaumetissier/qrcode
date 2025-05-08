<?php

namespace ThePhpGuild\QrCode\Step2DataEncodation;

class DataBits implements BitsStringInterface
{
    public function __construct(private string $data = '')
    {
    }

    public function prepend(BitsStringInterface|string $data): self
    {
        $this->data = $data.$this->data;

        return $this;
    }

    public function append(BitsStringInterface|string $data): self
    {
        $this->data .= $data;

        return $this;
    }

    public function padLastCodeword(): self
    {
        $dataSize = strlen($this->data);
        $this->data = str_pad($this->data, $dataSize + (8 - $dataSize % 8), "0");

        return $this;
    }

    public function __toString(): string
    {
        return implode(' ', $this->toCodewords());
    }

    public function bitsCount(): int
    {
        return strlen($this->data);
    }

    public function getCodewordsCount(): string
    {
        return strlen($this->data) / 8;
    }

    public function toCodewords(): array
    {
        return str_split($this->data, 8);
    }
}
