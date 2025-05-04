<?php

namespace ThePhpGuild\QrCode\Step3ErrorCorrectionCoder\GeneratorPolynomial;

interface OperationsInterface
{
    public function add(?int $a, ?int $b): int;

    public function subtract(?int $a, ?int $b): int;

    public function multiply(?int $a, ?int $b): int;
}
