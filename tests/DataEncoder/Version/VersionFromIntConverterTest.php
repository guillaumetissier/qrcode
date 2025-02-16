<?php

namespace DataEncoder\Version;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\DataEncoder\Version\VersionFromIntConverter;
use ThePhpGuild\QrCode\Exception\UnknownVersion;

class VersionFromIntConverterTest extends TestCase
{
    private VersionFromIntConverter $converter;

    protected function setUp(): void
    {
        $this->converter = new VersionFromIntConverter();
    }

    public function testFromInt(): void
    {
        for ($i = 1; $i <= 40; $i++) {
            $this->assertInstanceOf(Version::class, $this->converter->fromInt($i));
        }
    }

    public function testInvalidVersionMin(): void
    {
        $this->expectException(UnknownVersion::class);
        $this->converter->fromInt(0);
    }

    public function testInvalidVersionMax(): void
    {
        $this->expectException(UnknownVersion::class);
        $this->converter->fromInt(41);
    }
}
