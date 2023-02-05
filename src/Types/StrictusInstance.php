<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Exceptions\StrictusTypeException;
use Strictus\Interfaces\StrictusTypeInterface;

/**
 * @internal
 */
final class StrictusInstance implements StrictusTypeInterface
{
    private ?string $instanceType;

    private string $errorMessage;

    /**
     * @param  mixed  $value
     * @param  bool  $nullable
     */
    public function __construct(private mixed $value, private bool $nullable)
    {
        if ($this->value === null && $this->nullable) {
            return;
        }

        if (gettype($this->value) === 'object') {
            $this->instanceType = $value::class;
        }

        $this->errorMessage = 'Expected Instance Of '.$this->value::class;

        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }
    }

    /**
     * @param  mixed  $value
     * @return mixed
     */
    public function __invoke(mixed $value = new StrictusUndefined()): mixed
    {
        if (! $value instanceof StrictusUndefined) {
            if (! $value instanceof $this->instanceType) {
                if ($this->nullable && $value !== null) {
                    throw new StrictusTypeException($this->errorMessage);
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

        if (! ($value instanceof $this->instanceType)) {
            throw new StrictusTypeException($this->errorMessage);
        }

        $this->value = $value;
    }

    public function get()
    {
        return $this->value;
    }

    public function set($value): void
    {
        $this->__invoke($value);
    }
}
