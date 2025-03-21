<?php

namespace ThePhpGuild\QrCode\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ThePhpGuild\QrCode\ErrorCorrectionEncoder\ErrorCorrectionLevel;
use ThePhpGuild\QrCode\MatrixRenderer\Output\OutputOptions;

class GenerateQrCodeCommand extends Command
{
    protected static $defaultName = 'app:generate-qrcode';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $generator = QrCodeGenerator::getQrCodeGenerator();
        $data = $generator
            ->setData('HELLO WORLD')
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
            ->setOutputOptions(new OutputOptions([
                OutputOptions::FILENAME => './qrcode.png',
            ]))
            ->generate()
        ;
        $output->writeln($data);
        return Command::SUCCESS;
    }
}
