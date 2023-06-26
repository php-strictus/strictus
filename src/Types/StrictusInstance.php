<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Concerns\StrictusTyping;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Interfaces\StrictusTypeInterface;

/**
 * @internal
 */
final class StrictusInstance implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $errorMessage;

    public function __construct(private string $instanceType, mixed $value, private bool $nullable)
    {
        $this->errorMessage = 'Expected Instance Of ' . $this->instanceType;

        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->validate($value);
        $this->setValue($value);
    }

    private function validate(mixed $value): void
    {
        if ($value === null && ! $this->nullable) {
            throw new StrictusTypeException($this->errorMessage);
        }

        if ($value !== null && gettype($value) !== 'object') {
            throw new StrictusTypeException($this->errorMessage);
        }

        if ($value !== null && $value::class !== $this->instanceType) {
            throw new StrictusTypeException($this->errorMessage);
        }
    }

    private function setValue(mixed $value): void
    {
        /** @var object|null $value */
        $this->value = $value
            ? clone $value
            : null;
    }
}
