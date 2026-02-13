<?php

namespace Guillaumetissier\QrCode\Tests\BitString;

use Guillaumetissier\QrCode\BitString\ErrorCorrectionLevelIndicator;
use Guillaumetissier\QrCode\Enums\ErrorCorrectionLevel;
use Guillaumetissier\QrCode\Exception\MissingInfoException;
use PHPUnit\Framework\TestCase;

class ErrorCorrectionLevelIndicatorTest extends TestCase
{
    /**
     * @param ErrorCorrectionLevel $ecl
     * @param string $expected
     * @return void
     *
     * @throws MissingInfoException
     *
     * @dataProvider dataToString
     */
    public function testToString(ErrorCorrectionLevel $ecl, string $expected): void
    {
        $this->assertEquals(
            $expected,
            ErrorCorrectionLevelIndicator::create()
                ->withErrorCorrectionLevel($ecl)
                ->bitString()
                ->toString()
        );
    }

    public static function dataToString(): \Generator
    {
        yield 'Low' => [ErrorCorrectionLevel::LOW, '01'];
        yield 'Medium' => [ErrorCorrectionLevel::MEDIUM, '00'];
        yield 'Quartile' => [ErrorCorrectionLevel::QUARTILE, '11'];
        yield 'High' => [ErrorCorrectionLevel::HIGH, '10'];
    }
}
