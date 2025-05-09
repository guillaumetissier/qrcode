<?php

namespace ThePhpGuild\QrCode\BitsString;

class DataBits implements BitsStringInterface
{
    public function __construct(private BitsStringInterface|string|array $data = '')
    {
        $this->data = $this->toBitsString($data);
    }

    public function prepend(BitsStringInterface|string|array $data): self
    {
        $this->data = $this->toBitsString($data).$this->data;

        return $this;
    }

    public function append(BitsStringInterface|string|array $data): self
    {
        $this->data .= $this->toBitsString($data);

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

    private function toBitsString(BitsStringInterface|string|array $data): string
    {
        if ($data instanceof BitsStringInterface) {
            return str_replace(' ', '', "$data");
        }

        if (is_string($data)) {
            if (!preg_match('/^[01\s]*$/', $data)) {
                throw new \InvalidArgumentException("Invalid string provided");
            }
            return str_replace(' ', '', "$data");
        }

        $string = implode('', $data);
        if (preg_match('/^[01\s]*$/', $string)) {
            return str_replace(' ', '', $string);
        }

        foreach ($data as &$value) {
            $value = sprintf('%08b', $value);
        }

        return implode('', $data);
    }
}
