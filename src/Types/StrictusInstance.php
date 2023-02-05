<?php

namespace Strictus\Strictus\Types;

use Strictus\Strictus\Interfaces\StrictusTypeInterface;
use TypeError;

class StrictusInstance implements StrictusTypeInterface
{
    private string $instanceType;

    private string $errorMessage;

    public function __construct(private mixed $value, private bool $nullable) {
        $this->instanceType = $value::class;
        $this->errorMessage = 'Expected Instance Of ' . $this->value::class;

        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }

    public function __invoke(mixed $value = new StrictusUndefined())
    {
        if (!$value instanceof StrictusUndefined) {
            if (!$value instanceof $this->instanceType) {
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

        if (!$value instanceof $this->instanceType) {
            throw new TypeError($this->errorMessage);
        }

        $this->value = $value;
    }
}

