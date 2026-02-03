<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\BitMatrixMasker\Masker;

use Generator;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker0;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker1;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker2;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker3;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker4;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker5;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker6;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\Masker7;
use Guillaumetissier\QrCode\BitMatrixBuilder\BitMatrixMasker\Masker\MaskerFactory;
use Guillaumetissier\QrCode\Enums\Mask;
use PHPUnit\Framework\TestCase;

final class MaskerFactoryTest extends TestCase
{
    /**
     * @param Mask $mask
     * @param class-string $expectedInstance
     * @return void
     * @dataProvider dataCreateMasker
     */
    public function testCreateMasker(Mask $mask, string $expectedInstance): void
    {
        $this->assertInstanceOf($expectedInstance, MaskerFactory::create()->createMasker($mask));
    }

    /**
     * @return Generator<array{Mask, class-string}>
     */
    public static function dataCreateMasker(): Generator
    {
        yield [Mask::MASK0, Masker0::class];
        yield [Mask::MASK1, Masker1::class];
        yield [Mask::MASK2, Masker2::class];
        yield [Mask::MASK3, Masker3::class];
        yield [Mask::MASK4, Masker4::class];
        yield [Mask::MASK5, Masker5::class];
        yield [Mask::MASK6, Masker6::class];
        yield [Mask::MASK7, Masker7::class];
    }
}
