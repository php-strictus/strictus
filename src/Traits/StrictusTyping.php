<?php

declare(strict_types=1);

namespace Strictus\Traits;

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Types\StrictusUndefined;

/**
 * @internal
 */
trait StrictusTyping
{
    /**
     * @param  mixed  $value
     * @param  bool  $nullable
     */
    public function __construct(private mixed $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->validate($value);
    }

    /**
     * @param  mixed  $value
     * @return mixed
     */
    public function __invoke(mixed $value = new StrictusUndefined()): mixed
    {
        if ($value instanceof StrictusUndefined) {
            return $this->value;
        }

        $this->validate($value);

        $this->value = $value;

        return $this;
    }

    /**
     * @param  string  $value
     * @return mixed
     */
    public function __get(string $value): mixed
    {
        return $this->value;
    }

    /**
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function __set(string $name, mixed $value): void
    {
        if ($name !== 'value') {
            return;
        }

        $this->validate($value);

        $this->value = $value;
    }

    /**
     * @param  mixed  $value
     * @return void
     */
    private function validate(mixed $value): void
    {
        if ($value === null && ! $this->nullable) {
            throw new StrictusTypeException($this->errorMessage);
        }

        if (gettype($value) !== $this->instanceType && $value !== null) {
            throw new StrictusTypeException($this->errorMessage);
        }
    }
}
