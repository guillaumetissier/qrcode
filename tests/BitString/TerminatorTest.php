<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\BitString\Terminator;

class TerminatorTest extends TestCase
{
    public function testToString(): void
    {
        $this->assertEquals('0000', Terminator::create()->bitString()->toString());
    }
}
