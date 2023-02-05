<?php

namespace Strictus\Strictus\Traits;

use Strictus\Strictus\Types\StrictusUndefined;
use TypeError;

trait StrictusTyping
{
    public function __invoke(mixed $value = new StrictusUndefined())
    {
        if (!$value instanceof StrictusUndefined) {
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

    public function __get(string $value)
    {
        return $this->$value;
    }

    public function __set(string $name, $value): void
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