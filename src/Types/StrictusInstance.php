<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Interfaces\StrictusTypeInterface;
use Strictus\Traits\StrictusTyping;

/**
 * @internal
 */
final class StrictusInstance implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $errorMessage;

    public function __construct(private string $instanceType, private mixed $value, private bool $nullable)
    {
        $this->errorMessage = 'Expected Instance Of '.$this->instanceType;

        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->validate($value);
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
}
