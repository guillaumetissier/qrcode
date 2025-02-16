<?php

namespace Tests\DataEncoder\Padding\TotalBitsCounter;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\CciBitsCounter\CciBitsCounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\EncodedDataBitsCounter\EncodedDataBitsCounterInterface;
use ThePhpGuild\QrCode\DataEncoder\Padding\TotalBitsCounter\TotalBitsCounter;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;

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
