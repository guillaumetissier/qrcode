<?php

namespace ThePhpGuild\QrCode\Logger;

use Psr\Log\LoggerInterface;

class ConsoleLogger implements LoggerInterface
{
    public function emergency(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[EME] $message" . PHP_EOL, 'white', 'black');
    }

    public function alert(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[ALE] $message" , 'black', 'red'). PHP_EOL;
    }

    public function critical(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[CRI] $message" , 'black', 'yellow'). PHP_EOL;
    }

    public function error(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[ERR] $message" , 'red'). PHP_EOL;
    }

    public function warning(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[WAR] $message", 'yellow'). PHP_EOL;
    }

    public function notice(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[NOT] $message", 'green'). PHP_EOL;
    }

    public function info(\Stringable|string $message, array $context = []): void
    {
        echo $this->coloredText("[INF] $message", 'blue') . PHP_EOL;
    }

    public function debug(\Stringable|string $message, array $context = []): void
    {
        echo "[DEB] $message" . PHP_EOL;
    }

    public function log($level, \Stringable|string $message, array $context = []): void
    {
        // TODO: Implement log() method.
    }

    private function coloredText(string $text, string $textColor, string $bgColor = null): string
    {
        $colors = [
            'black'   => '30', 'red'    => '31', 'green'  => '32',
            'yellow'  => '33', 'blue'   => '34', 'magenta'=> '35',
            'cyan'    => '36', 'white'  => '37', 'default'=> '39'
        ];

        $backgrounds = [
            'black'   => '40', 'red'    => '41', 'green'  => '42',
            'yellow'  => '43', 'blue'   => '44', 'magenta'=> '45',
            'cyan'    => '46', 'white'  => '47', 'default'=> '49',
            'orange'  => '38;5;208',
        ];

        $textCode = $colors[$textColor] ?? '39';
        $bgCode = $backgrounds[$bgColor] ?? '49';

        return "\e[{$textCode};{$bgCode}m{$text}\e[0m";
    }
}