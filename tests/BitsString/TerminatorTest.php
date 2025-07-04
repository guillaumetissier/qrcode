<?php

namespace Tests\BitsString;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\BitsString\Terminator;

class TerminatorTest extends TestCase
{
    private Terminator $terminator;

    public function setUp(): void
    {
        $this->terminator = new Terminator();
    }

    public function testToString(): void
    {
        $this->assertEquals('0000', "{$this->terminator}");
    }

    public function testBitsCount(): void
    {
        $this->assertEquals(4, $this->terminator->bitsCount());
    }
}
