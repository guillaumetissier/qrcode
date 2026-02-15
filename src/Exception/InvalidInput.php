<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

use Guillaumetissier\PathUtilities\Path;

final class InvalidInput extends \Exception
{
    public static function invalidPath(Path $path): self
    {
        return new self("Path ($path) does not exist or is not writable.");
    }

    public static function outOfRange(string $varName, int $varValue, int $min, int $max): self
    {
        return new self("Value of input '$varName' ($varValue) must be between $min and $max");
    }

    /**
     * @param string $varName
     * @param string $varValue
     * @param string[] $validValues
     * @return self
     */
    public static function notInSet(string $varName, string $varValue, array $validValues): self
    {
        return new self(sprintf(
            "Value of input '$varName' ($varValue) must be in set [%s]",
            implode(', ', $validValues)
        ));
    }

    /**
     * @param string $varName
     * @return self
     */
    public static function notNumeric(string $varName): self
    {
        return new self("Value of input '$varName' should be a numeric.");
    }

    private function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::INVALID_INPUT->value);
    }
}
