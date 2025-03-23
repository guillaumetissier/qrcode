<?php

namespace ThePhpGuild\QrCode\Commands;

use Psr\Log\LogLevel;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\Logger\ConsoleLogger;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class GenerateQrCodeCommand extends Command
{
    protected static $defaultName = 'app:generate-qrcode';

    protected function configure(): void
    {
        $this
            ->addOption('text', 'T', InputOption::VALUE_REQUIRED, 'desc')
            ->addOption('filename', 'F', InputOption::VALUE_OPTIONAL, 'desc', null)
            ->addOption('logLevel', 'L', InputOption::VALUE_OPTIONAL, 'desc', LogLevel::WARNING)
            ->addOption('scale', 'S', InputOption::VALUE_OPTIONAL, 'desc', 1)
            ->addOption('quality', 'Q', InputOption::VALUE_OPTIONAL, 'Quality of the image [0-100]', 80)
            ->addOption('fileType', 't', InputArgument::OPTIONAL, 'File Type', 'png')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (null === ($text = $input->getOption('text'))) {
            exit('Enter a text to encode' . PHP_EOL);
        }
        $logLevel = str_replace('=', '', $input->getOption('logLevel'));

        $generator = QrCodeGenerator::getQrCodeGenerator(new ConsoleLogger(), $logLevel);

        $generator
            ->setData($text)
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
            ->setOutputOptions(new OutputOptions([
                OutputOptions::FILENAME => './qrcode.png',
            ]))
            ->generate()
        ;

        return Command::SUCCESS;
    }
}
