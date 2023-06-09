<?php

declare(strict_types=1);

namespace Strictus\Traits;

use ReflectionClass;

/**
 * @internal
 */
trait Cloneable
{
    public function clone(mixed $value): static
    {
        $reflectionClass = new ReflectionClass(static::class);
        $constructorParameters = $reflectionClass->getConstructor()->getParameters();
        $cloneArguments = [
            'value' => $value,
        ];
        foreach ($constructorParameters as $parameter) {
            $parameterName = $parameter->getName();
            if ($parameterName === 'value') {
                continue;
            }
            $property = $reflectionClass->getProperty($parameterName);
            $cloneArguments[$parameterName] = $property->getValue($this);
        }

        return new static(...$cloneArguments);
    }
}
