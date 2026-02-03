<?php

namespace Guillaumetissier\QrCode\Tests\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Tests\Logger\LoggerTestCase;
use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks as CB;
use Guillaumetissier\QrCode\Enums\Version;

class CodewordBlocksFactoryTest extends LoggerTestCase
{
    private CB\CodewordBlocksFactory $codewordBlocksFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->codewordBlocksFactory = CB\CodewordBlocksFactory::create($this->logger);
    }

    /**
     * @param Version $version
     * @param class-string $expectedClass
     *
     * @dataProvider provideDataToTestGetCodewordsAssembler
     */
    public function testGetCodewordsAssembler(Version $version, string $expectedClass): void
    {
        $this->assertInstanceOf(
            $expectedClass,
            $this->codewordBlocksFactory->getCodewordBlocks($version)
        );
    }

    public static function provideDataToTestGetCodewordsAssembler(): \Generator
    {
        yield [Version::V01, CB\V01CodewordBlocks::class];
        yield [Version::V02, CB\V02CodewordBlocks::class];
        yield [Version::V03, CB\V03CodewordBlocks::class];
        yield [Version::V04, CB\V04CodewordBlocks::class];
        yield [Version::V05, CB\V05CodewordBlocks::class];
        yield [Version::V06, CB\V06CodewordBlocks::class];
        yield [Version::V07, CB\V07CodewordBlocks::class];
        yield [Version::V08, CB\V08CodewordBlocks::class];
        yield [Version::V09, CB\V09CodewordBlocks::class];
        yield [Version::V10, CB\V10CodewordBlocks::class];
        yield [Version::V11, CB\V11CodewordBlocks::class];
        yield [Version::V12, CB\V12CodewordBlocks::class];
        yield [Version::V13, CB\V13CodewordBlocks::class];
        yield [Version::V14, CB\V14CodewordBlocks::class];
        yield [Version::V15, CB\V15CodewordBlocks::class];
        yield [Version::V16, CB\V16CodewordBlocks::class];
        yield [Version::V17, CB\V17CodewordBlocks::class];
        yield [Version::V18, CB\V18CodewordBlocks::class];
        yield [Version::V19, CB\V19CodewordBlocks::class];
        yield [Version::V20, CB\V20CodewordBlocks::class];
        yield [Version::V21, CB\V21CodewordBlocks::class];
        yield [Version::V22, CB\V22CodewordBlocks::class];
    }
}
