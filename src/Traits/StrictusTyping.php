<?php

namespace Strictus\Traits;

use Strictus\Types\StrictusUndefined;
use TypeError;

trait StrictusTyping
{
    /**
     * @param  mixed  $value
     * @return mixed
     */
    public function __invoke(mixed $value = new StrictusUndefined()): mixed
    {
        if (! $value instanceof StrictusUndefined) {
            if (gettype($value) !== $this->instanceType) {
                if ($this->nullable && $value !== null) {
                    throw new TypeError($this->errorMessage);
                }
            }

            $this->value = $value;

            return $this;
        }

        return $this->value;
    }

    /**
     * @param  string  $value
     * @return mixed
     */
    public function __get(string $value): mixed
    {
        return $this->$value;
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
            throw new TypeError($this->errorMessage);
        }

        $this->value = $value;
    }
}
