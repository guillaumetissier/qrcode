<?php

namespace Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocks;

use Guillaumetissier\QrCode\Encoder\FinalCodewordsAssembler\CodewordBlocksFactoryInterface;
use Guillaumetissier\QrCode\Enums\Version;
use Guillaumetissier\QrCode\Logger\IOLoggerInterface;

final class CodewordBlocksFactory implements CodewordBlocksFactoryInterface
{
    public static function create(?IOLoggerInterface $logger = null): self
    {
        return new CodewordBlocksFactory($logger);
    }

    private function __construct(private readonly ?IOLoggerInterface $logger = null)
    {
    }

    public function getCodewordBlocks(Version $version): CodewordBlocksInterface
    {
        $this->logger?->input("Version = {$version->value}", ['class' => self::class]);

        $namespace = substr(get_class($this), 0, (int)strrpos(get_class($this), '\\'));
        $class = "$namespace\\V" . str_pad("{$version->value}", 2, '0', STR_PAD_LEFT) . 'CodewordBlocks';

        $this->logger?->output("Creation of $class", ['class' => self::class]);

        return new $class($this->logger);
    }
}
