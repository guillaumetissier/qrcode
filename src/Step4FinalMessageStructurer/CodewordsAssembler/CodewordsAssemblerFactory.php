<?php

namespace ThePhpGuild\QrCode\Step4FinalMessageStructurer\CodewordsAssembler;

use ThePhpGuild\QrCode\Enums\Version;
use ThePhpGuild\QrCode\Logger\IOLoggerInterface;

class CodewordsAssemblerFactory
{
    private ?Version $version = null;

    public function __construct(private readonly IOLoggerInterface $logger)
    {}

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getCodewordsAssembler(): CodewordsAssemblerInterface
    {
        $this->logger->input("Version = {$this->version->value}", ['class' => static::class]);

        $namespace = substr(get_class($this), 0, strrpos(get_class($this), '\\'));
        $class = "$namespace\\V" . str_pad($this->version->value, 2, '0', STR_PAD_LEFT) . 'CodewordsAssembler';

        $this->logger->output("Creation of $class", ['class' => static::class]);

        return new $class($this->logger);
    }
}
