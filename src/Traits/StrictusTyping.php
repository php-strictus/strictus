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
    private mixed $value;

    /**
     * @param  mixed  $value
     * @return mixed
     */
    public function __invoke(mixed $value = new StrictusUndefined()): mixed
    {
        if ($value instanceof StrictusUndefined) {
            return $this->value;
        }

        if ($value === null && !$this->nullable) {
            throw new StrictusTypeException($this->errorMessage);
        }

        if (gettype($value) !== $this->instanceType) {
            if ($this->nullable && $value !== null) {
                throw new StrictusTypeException($this->errorMessage);
            }
        }

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

        if (
            gettype($value) !== $this->instanceType
            || ($this->nullable && $value !== null)
        ) {
            throw new StrictusTypeException($this->errorMessage);
        }

        $this->value = $value;
    }

    public function handleInstantiation(mixed $value)
    {
        if (gettype($value) !== $this->instanceType) {
            if (!$this->nullable) {
                throw new StrictusTypeException($this->errorMessage);
            } else if ($value !== null) {
                throw new StrictusTypeException($this->errorMessage);
            }
        }
    }
}
