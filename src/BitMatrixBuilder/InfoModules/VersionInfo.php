<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;

final class VersionInfo
{
    public static function create(Version $version): self
    {
        return new self($version);
    }

    private function __construct(private readonly Version $version)
    {
    }

    private function __clone()
    {
    }

    /**
     * @return BitStringInterface|null
     * @throws MissingInfoException
     */
    public function bitString(): ?BitStringInterface
    {
        if (!$this->version instanceof Version) {
            throw MissingInfoException::missingInfo('version', self::class);
        }

        $bitString = match ($this->version) {
            Version::V07 => BitStringFormatter::normalize("00 0111 1100 1001 0100"),
            Version::V08 => BitStringFormatter::normalize("00 1000 0101 1011 1100"),
            Version::V09 => BitStringFormatter::normalize("00 1001 1010 1001 1001"),
            Version::V10 => BitStringFormatter::normalize("00 1010 0100 1101 0011"),
            Version::V11 => BitStringFormatter::normalize("00 1011 1011 1111 0110"),
            Version::V12 => BitStringFormatter::normalize("00 1100 0111 0110 0010"),
            Version::V13 => BitStringFormatter::normalize("00 1101 1000 0100 0111"),
            Version::V14 => BitStringFormatter::normalize("00 1110 0110 0000 1101"),
            Version::V15 => BitStringFormatter::normalize("00 1111 1001 0010 1000"),
            Version::V16 => BitStringFormatter::normalize("01 0000 1011 0111 1000"),
            Version::V17 => BitStringFormatter::normalize("01 0001 0100 0101 1101"),
            Version::V18 => BitStringFormatter::normalize("01 0010 1010 0001 0111"),
            Version::V19 => BitStringFormatter::normalize("01 0011 0101 0011 0010"),
            Version::V20 => BitStringFormatter::normalize("01 0100 1001 1010 0110"),
            Version::V21 => BitStringFormatter::normalize("01 0101 0110 1000 0011"),
            Version::V22 => BitStringFormatter::normalize("01 0110 1000 1100 1001"),
            Version::V23 => BitStringFormatter::normalize("01 0111 0111 1110 1100"),
            Version::V24 => BitStringFormatter::normalize("01 1000 1110 1100 0100"),
            Version::V25 => BitStringFormatter::normalize("01 1001 0001 1110 0001"),
            Version::V26 => BitStringFormatter::normalize("01 1010 1111 1010 1011"),
            Version::V27 => BitStringFormatter::normalize("01 1011 0000 1000 1110"),
            Version::V28 => BitStringFormatter::normalize("01 1100 1100 0001 1010"),
            Version::V29 => BitStringFormatter::normalize("01 1101 0011 0011 1111"),
            Version::V30 => BitStringFormatter::normalize("01 1110 1101 0111 0101"),
            Version::V31 => BitStringFormatter::normalize("01 1111 0010 0101 0000"),
            Version::V32 => BitStringFormatter::normalize("10 0000 1001 1101 0101"),
            Version::V33 => BitStringFormatter::normalize("10 0001 0110 1111 0000"),
            Version::V34 => BitStringFormatter::normalize("10 0010 1000 1011 1010"),
            Version::V35 => BitStringFormatter::normalize("10 0011 0111 1001 1111"),
            Version::V36 => BitStringFormatter::normalize("10 0100 1011 0000 1011"),
            Version::V37 => BitStringFormatter::normalize("10 0101 0100 0010 1110"),
            Version::V38 => BitStringFormatter::normalize("10 0110 1010 0110 0100"),
            Version::V39 => BitStringFormatter::normalize("10 0111 0101 0100 0001"),
            Version::V40 => BitStringFormatter::normalize("10 1000 1100 0110 1001"),
            default => null
        };

        if ($bitString === null) {
            return null;
        }

        return BitStringImmutable::fromString($bitString);
    }
}
