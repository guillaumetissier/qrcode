<?php

namespace Tests\DataEncoder\Encoder;

use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Encoder\EncoderInterface;

class BaseEncoderTestCase extends TestCase
{
    protected EncoderInterface $encoder;

    /**
     * @dataProvider provideDataToEncode
     */
    public function testEncode(string $data, string $expectedEncodedData): void
    {
        $this->assertEquals(
            str_replace([' ', '\t', PHP_EOL], '', $expectedEncodedData),
            $this->encoder->setData($data)->encode()
        );
    }

    public static function provideDataToEncode(): array
    {
        throw new \Exception('Should not be used');
    }
}
