<?php

declare(strict_types=1);

namespace Strictus\Types;

use Strictus\Concerns\StrictusTyping;
use Strictus\Enums\Type;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Interfaces\StrictusTypeInterface;
use UnitEnum;

/**
 * @internal
 *
 * @property ?StrictusTypeInterface $value
 */
final class StrictusUnion implements StrictusTypeInterface
{
    use StrictusTyping;

    private string $errorMessage = 'Expected Union';

    private ?Type $type = null;

    /** @var array<string, class-string>|null */
    private ?array $instances = null;

    /**
     * @param  array<int, Type>  $types
     */
    public function __construct(private array $types, mixed $value, private bool $nullable)
    {
        if ($this->nullable) {
            $this->errorMessage .= ' Or Null';
        }

        $this->validateTypes($types);

        $this->validate($value);

        $this->value = $this->getStrictusType($value);
    }

    public function __invoke(mixed $value = new StrictusUndefined()): mixed
    {
        if ($value instanceof StrictusUndefined) {
            return $this->value?->value;
        }

        $this->immutableValidate();

        $this->validate($value);

        $this->value = $this->getStrictusType($value);

        return $this;
    }

    public function __get(string $value): mixed
    {
        return $this->value?->value;
    }

    public function __set(string $name, mixed $value): void
    {
        if ($name !== 'value') {
            return;
        }

        $this->immutableValidate();

        $this->validate($value);

        $this->value = $this->getStrictusType($value);
    }

    /**
     * @param  array<int, Type>  $types $types
     */
    private function validateTypes(array $types): void
    {
        foreach ($types as $type) {
            if (! $type instanceof Type) {
                throw StrictusTypeException::becauseInvalidSupportedType();
            }
        }
    }

    private function validate(mixed $value): void
    {
        if ($value === null && ! $this->nullable) {
            throw new StrictusTypeException($this->errorMessage);
        }

        $this->detectType($value);
        if ($value !== null && ! in_array($this->type, $this->types, true)) {
            throw new StrictusTypeException($this->errorMessage);
        }
    }

    private function detectType(mixed $value): void
    {
        if (is_null($value)) {
            $this->type = null;

            return;
        }

        if (is_int($value)) {
            $this->type = Type::INT;

            return;
        }

        if (is_string($value)) {
            $this->type = Type::STRING;

            return;
        }

        if (is_float($value)) {
            $this->type = Type::FLOAT;

            return;
        }

        if (is_bool($value)) {
            $this->type = Type::BOOLEAN;

            return;
        }

        if (is_array($value)) {
            $this->type = Type::ARRAY;

            return;
        }

        if (false === is_object($value)) {
            throw StrictusTypeException::becauseNotSupportedType(gettype($value));
        }

        $class = get_class($value);
        if ('stdClass' === $class) {
            $this->type = Type::OBJECT;

            return;
        }

        if ($value instanceof UnitEnum) {
            $this->type = Type::ENUM;
            $this->setInstance($class);

            return;
        }

        if (class_exists($class)) {
            $this->type = Type::INSTANCE;
            $this->setInstance($class);

            return;
        }

        throw StrictusTypeException::becauseNotSupportedType(gettype($value));
    }

    /**
     * @param class-string $instance
     * @return void
     */
    private function setInstance(string $instance): void
    {
        if (null === $this->type) {
            throw StrictusTypeException::becauseNullInstanceType();
        }

        if (Type::ENUM !== $this->type && Type::INSTANCE !== $this->type) {
            throw StrictusTypeException::becauseUnInstanceableType();
        }

        if (isset($this->instances[$this->type->name]) && $this->instances[$this->type->name]) {
            return;
        }

        $this->instances = [
            $this->type->name => $instance,
        ];
    }

    private function getStrictusType(mixed $value): ?StrictusTypeInterface
    {
        return match ($this->type) {
            null => null,
            Type::INT => new StrictusInteger($value, $this->nullable),
            Type::STRING => new StrictusString($value, $this->nullable),
            Type::FLOAT => new StrictusFloat($value, $this->nullable),
            Type::BOOLEAN => new StrictusBoolean($value, $this->nullable),
            Type::ARRAY => new StrictusArray($value, $this->nullable),
            Type::OBJECT => new StrictusObject($value, $this->nullable),
            default => $this->getInstanceableStrictusType($value),
        };
    }

    private function getInstanceableStrictusType(mixed $value): StrictusTypeInterface
    {
        if (null === $this->type) {
            throw StrictusTypeException::becauseInvalidSupportedType();
        }

        if (null === $this->instances || (! isset($this->instances[$this->type->name]))) {
            throw StrictusTypeException::becauseNullInstanceType();
        }

        return match ($this->type) {
            Type::INSTANCE => new StrictusInstance($this->instances[$this->type->name], $value, $this->nullable),
            Type::ENUM => new StrictusEnum($this->instances[$this->type->name], $value, $this->nullable),
            default => throw StrictusTypeException::becauseUnInstanceableType(),
        };
    }
}
