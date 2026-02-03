<?php

declare(strict_types=1);

namespace Guillaumetissier\QrCode\Exception;

final class InvalidOutputOptionsException extends \Exception
{
    /**
     * @param string[] $variables
     * @return self
     */
    public static function allVariablesNull(array $variables): self
    {
        return new self(sprintf("%s are all NULL. Expected at least one to be set.", join(', ', $variables)));
    }

    public static function outOfRange(string $name, int $value, int $min, int $max): self
    {
        return new self("$name ($value) is out of range. Value expected between [$min, $max]");
    }

    public function __construct(string $message)
    {
        parent::__construct($message, ExceptionCode::INVALID_OUTPUT_OPTION->value);
    }
}
