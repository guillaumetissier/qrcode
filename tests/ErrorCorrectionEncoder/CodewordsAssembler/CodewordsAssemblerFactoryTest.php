<?php

namespace Tests\ErrorCorrectionEncoder\CodewordsAssembler;

use Tests\Logger\LoggerTestCase;
use ThePhpGuild\QrCode\DataEncoder\Version\Version;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\CodewordsAssembler as CA;

class CodewordsAssemblerFactoryTest extends LoggerTestCase
{
    private CA\CodewordsAssemblerFactory $codewordsAssemblerFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordsAssemblerFactory = new CA\CodewordsAssemblerFactory($this->logger);
    }

    /**
     * @dataProvider provideDataToTestGetCodewordsAssembler
     */
    public function testGetCodewordsAssembler(Version $version, string $expectedClass): void
    {
        $this->assertInstanceOf(
            $expectedClass,
            $this->codewordsAssemblerFactory->setVersion($version)->getCodewordsAssembler()
        );
    }

    public static function provideDataToTestGetCodewordsAssembler(): \Generator
    {
        yield [Version::V01, CA\V01CodewordsAssembler::class];
        yield [Version::V02, CA\V02CodewordsAssembler::class];
        yield [Version::V03, CA\V03CodewordsAssembler::class];
        yield [Version::V04, CA\V04CodewordsAssembler::class];
        yield [Version::V05, CA\V05CodewordsAssembler::class];
        yield [Version::V06, CA\V06CodewordsAssembler::class];
        yield [Version::V07, CA\V07CodewordsAssembler::class];
        yield [Version::V08, CA\V08CodewordsAssembler::class];
        yield [Version::V09, CA\V09CodewordsAssembler::class];
        yield [Version::V10, CA\V10CodewordsAssembler::class];
        yield [Version::V11, CA\V11CodewordsAssembler::class];
        yield [Version::V12, CA\V12CodewordsAssembler::class];
        yield [Version::V13, CA\V13CodewordsAssembler::class];
        yield [Version::V14, CA\V14CodewordsAssembler::class];
        yield [Version::V15, CA\V15CodewordsAssembler::class];
        yield [Version::V16, CA\V16CodewordsAssembler::class];
        yield [Version::V17, CA\V17CodewordsAssembler::class];
        yield [Version::V18, CA\V18CodewordsAssembler::class];
        yield [Version::V19, CA\V19CodewordsAssembler::class];
        yield [Version::V20, CA\V20CodewordsAssembler::class];
        yield [Version::V21, CA\V21CodewordsAssembler::class];
        yield [Version::V22, CA\V22CodewordsAssembler::class];
    }
}
