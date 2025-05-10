<?php

namespace ThePhpGuild\QrCode\Scalar\Operations;

interface OperationsInterface
{
    public function add(?int $a, ?int $b): int;

    public function subtract(?int $a, ?int $b): int;

    public function multiply(?int $a, ?int $b): int;

    public function divide(?int $a, ?int $b): int;
}
