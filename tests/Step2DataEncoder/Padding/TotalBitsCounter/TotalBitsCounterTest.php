<?php

namespace Tests\Step2DataEncoder\Padding\TotalBitsCounter;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\Step1DataAnalyser\Version\Version;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\CciBitsCounterInterface;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\EncodedDataBitsCounterInterface;
use ThePhpGuild\QrCode\Step2DataEncoder\Padding\TotalBitsCounter\TotalBitsCounter;

class TotalBitsCounterTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCount(): void
    {
        $cciBitsCounterMock = $this->createMock(CciBitsCounterInterface::class);
        $cciBitsCounterMock->method('setVersion')->willReturnSelf();
        $cciBitsCounterMock->method('count')->willReturn(13);

        $encodedDataBitsCounterMock = $this->createMock(EncodedDataBitsCounterInterface::class);
        $encodedDataBitsCounterMock->method('setDataLength')->willReturnSelf();
        $encodedDataBitsCounterMock->method('count')->willReturn(2101);

        $counter = new TotalBitsCounter($cciBitsCounterMock, $encodedDataBitsCounterMock);

        $this->assertEquals(4 + 13 + 2101, $counter->setVersion(Version::V14)->setDataLength(382)->count());
    }
}
