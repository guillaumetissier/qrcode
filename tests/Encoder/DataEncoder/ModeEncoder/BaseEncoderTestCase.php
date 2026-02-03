<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\DataEncoder\ModeEncoder;

use Exception;
use PHPUnit\Framework\TestCase;
use Guillaumetissier\QrCode\Encoder\DataEncoder\ModeEncoder\ModeEncoderInterface;

class BaseEncoderTestCase extends TestCase
{
    protected ModeEncoderInterface $encoder;

    /**
     * @dataProvider provideDataToEncode
     */
    public function testEncode(string $data, string $expectedEncodedData): void
    {
        $this->assertEquals(
            str_replace([' ', '\t', PHP_EOL], '', $expectedEncodedData),
            $this->encoder->withData($data)->encode()->toString()
        );
    }

    /**
     * @return array<array{string, string}>
     * @throws Exception
     */
    public static function provideDataToEncode(): array
    {
        throw new Exception('Should not be used');
    }
}
