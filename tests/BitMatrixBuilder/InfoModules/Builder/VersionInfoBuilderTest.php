<?php

namespace Guillaumetissier\QrCode\Tests\BitMatrixBuilder\InfoModules\Builder;

use Guillaumetissier\QrCode\BitMatrixBuilder\InfoModules\Builder\VersionInfoBuilder;
use Guillaumetissier\QrCode\Common\Helper\BitStringFormatter;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

final class VersionInfoBuilderTest extends TestCase
{
    private VersionInfoBuilder $builder;

    public function setUp(): void
    {
        $this->builder = VersionInfoBuilder::create();
    }

    /**
     * @param Version $version
     * @param ?string $expected
     * @return void
     * @throws MissingInfoException
     *
     * @dataProvider dataBuild
     */
    public function testBuild(Version $version, ?string $expected): void
    {
        $this->assertSame($expected, $this->builder->withVersion($version)->build()?->toString());
    }

    public static function dataBuild(): \Generator
    {
        return [
            yield 'Version 01' => [Version::V01, null],
            yield 'Version 02' => [Version::V02, null],
            yield 'Version 03' => [Version::V03, null],
            yield 'Version 04' => [Version::V04, null],
            yield 'Version 05' => [Version::V05, null],
            yield 'Version 06' => [Version::V06, null],
            yield 'Version 07' => [Version::V07, BitStringFormatter::normalize("00 0111 1100 1001 0100")],
            yield 'Version 08' => [Version::V08, BitStringFormatter::normalize("00 1000 0101 1011 1100")],
            yield 'Version 09' => [Version::V09, BitStringFormatter::normalize("00 1001 1010 1001 1001")],
            yield 'Version 10' => [Version::V10, BitStringFormatter::normalize("00 1010 0100 1101 0011")],
            yield 'Version 11' => [Version::V11, BitStringFormatter::normalize("00 1011 1011 1111 0110")],
            yield 'Version 12' => [Version::V12, BitStringFormatter::normalize("00 1100 0111 0110 0010")],
            yield 'Version 13' => [Version::V13, BitStringFormatter::normalize("00 1101 1000 0100 0111")],
            yield 'Version 14' => [Version::V14, BitStringFormatter::normalize("00 1110 0110 0000 1101")],
            yield 'Version 15' => [Version::V15, BitStringFormatter::normalize("00 1111 1001 0010 1000")],
            yield 'Version 16' => [Version::V16, BitStringFormatter::normalize("01 0000 1011 0111 1000")],
            yield 'Version 17' => [Version::V17, BitStringFormatter::normalize("01 0001 0100 0101 1101")],
            yield 'Version 18' => [Version::V18, BitStringFormatter::normalize("01 0010 1010 0001 0111")],
            yield 'Version 19' => [Version::V19, BitStringFormatter::normalize("01 0011 0101 0011 0010")],
            yield 'Version 20' => [Version::V20, BitStringFormatter::normalize("01 0100 1001 1010 0110")],
            yield 'Version 21' => [Version::V21, BitStringFormatter::normalize("01 0101 0110 1000 0011")],
            yield 'Version 22' => [Version::V22, BitStringFormatter::normalize("01 0110 1000 1100 1001")],
            yield 'Version 23' => [Version::V23, BitStringFormatter::normalize("01 0111 0111 1110 1100")],
            yield 'Version 24' => [Version::V24, BitStringFormatter::normalize("01 1000 1110 1100 0100")],
            yield 'Version 25' => [Version::V25, BitStringFormatter::normalize("01 1001 0001 1110 0001")],
            yield 'Version 26' => [Version::V26, BitStringFormatter::normalize("01 1010 1111 1010 1011")],
            yield 'Version 27' => [Version::V27, BitStringFormatter::normalize("01 1011 0000 1000 1110")],
            yield 'Version 28' => [Version::V28, BitStringFormatter::normalize("01 1100 1100 0001 1010")],
            yield 'Version 29' => [Version::V29, BitStringFormatter::normalize("01 1101 0011 0011 1111")],
            yield 'Version 30' => [Version::V30, BitStringFormatter::normalize("01 1110 1101 0111 0101")],
            yield 'Version 31' => [Version::V31, BitStringFormatter::normalize("01 1111 0010 0101 0000")],
            yield 'Version 32' => [Version::V32, BitStringFormatter::normalize("10 0000 1001 1101 0101")],
            yield 'Version 33' => [Version::V33, BitStringFormatter::normalize("10 0001 0110 1111 0000")],
            yield 'Version 34' => [Version::V34, BitStringFormatter::normalize("10 0010 1000 1011 1010")],
            yield 'Version 35' => [Version::V35, BitStringFormatter::normalize("10 0011 0111 1001 1111")],
            yield 'Version 36' => [Version::V36, BitStringFormatter::normalize("10 0100 1011 0000 1011")],
            yield 'Version 37' => [Version::V37, BitStringFormatter::normalize("10 0101 0100 0010 1110")],
            yield 'Version 38' => [Version::V38, BitStringFormatter::normalize("10 0110 1010 0110 0100")],
            yield 'Version 39' => [Version::V39, BitStringFormatter::normalize("10 0111 0101 0100 0001")],
            yield 'Version 40' => [Version::V40, BitStringFormatter::normalize("10 1000 1100 0110 1001")],
        ];
    }
}
