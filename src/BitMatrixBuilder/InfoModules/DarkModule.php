<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules;

use Guillaumetissier\BitString\BitStringImmutable;
use Guillaumetissier\BitString\BitStringInterface;
use Guillaumetissier\QrCode\BitString\BitStringAware;

final class DarkModule implements BitStringAware
{
    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function bitString(): BitStringInterface
    {
        return BitStringImmutable::fromString('1');
    }
}
