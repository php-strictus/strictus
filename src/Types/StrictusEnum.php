<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusEnum implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $errorMessage;

    public function __construct(private string $enumType, private mixed $value, private bool $nullable)
    {
        $this->errorMessage = 'Expected Enum Of ' . $this->enumType;

        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->validate($value);
    }

    private function validate(mixed $value): void
    {
        if (false === enum_exists($this->enumType)) {
            throw new StrictusTypeException('Invalid Enum Type');
        }

        if ($value === null && ! $this->nullable) {
            throw new StrictusTypeException($this->errorMessage);
        }

        if ($value !== null && ! $value instanceof $this->enumType) {
            throw new StrictusTypeException($this->errorMessage);
        }
    }
}
