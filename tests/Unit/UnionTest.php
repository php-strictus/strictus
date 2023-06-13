<?php

declare(strict_types=1);

use Strictus\Enums\Type;
use Strictus\Exceptions\ImmutableStrictusException;
use Strictus\Exceptions\StrictusTypeException;
use Strictus\Strictus;
use Strictus\Types\StrictusUnion;

it('instantiates variable')
    ->expect(fn () => Strictus::union([Type::INT, Type::STRING], 10))
    ->toBeInstanceOf(StrictusUnion::class);

it('instantiates a nullable variable', function () {
    $value = Strictus::union([Type::INT, Type::STRING], null, true);
    expect($value)
        ->toBeInstanceOf(StrictusUnion::class);

    $value = Strictus::nullableUnion([Type::INT, Type::STRING], null);
    expect($value)
        ->toBeInstanceOf(StrictusUnion::class);
});

it('throws exception when trying to instantiate non-nullable variable with null', function () {
    expect(fn () => Strictus::union([Type::INT, Type::STRING], null))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with wrong type', function () {
    expect(fn () => Strictus::union(['int', Type::STRING], 10))
        ->toThrow(StrictusTypeException::class);
});

it('throws exception when trying to instantiate variable with value has wrong type', function () {
    expect(fn () => Strictus::union([Type::INT, Type::STRING], false))
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => Strictus::union([Type::STRING, Type::ARRAY], (object) ['foo' => 'bar']))
        ->toThrow(StrictusTypeException::class);
});

it('returns the value correctly', function () {
    $integerValue = Strictus::union([Type::INT, Type::ARRAY], 1);

    expect($integerValue->value)
        ->toBe(1)
        ->and($integerValue())
        ->toBe(1);

    $stringValue = Strictus::union([Type::STRING, Type::INT], 'bar');

    expect($stringValue->value)
        ->toBe('bar')
        ->and($stringValue())
        ->toBe('bar');

    $floatValue = Strictus::union([Type::FLOAT, Type::INT], 1.5);

    expect($floatValue->value)
        ->toBe(1.5)
        ->and($floatValue())
        ->toBe(1.5);

    $boolValue = Strictus::union([Type::BOOLEAN, Type::FLOAT], true);

    expect($boolValue->value)
        ->toBe(true)
        ->and($boolValue())
        ->toBe(true);

    $arrayValue = Strictus::union([Type::ARRAY, Type::FLOAT], ['foo' => 'bar', 'bar' => 'foo']);

    expect($arrayValue->value)
        ->toBe(['foo' => 'bar', 'bar' => 'foo'])
        ->and($arrayValue())
        ->toBe(['foo' => 'bar', 'bar' => 'foo']);

    $objectValue = Strictus::union([Type::ENUM, Type::OBJECT], (object) ['foo' => 'bar']);

    expect($objectValue->value)
        ->toEqual((object) ['foo' => 'bar'])
        ->and($objectValue())
        ->toEqual((object) ['foo' => 'bar']);

    $instanceValue = Strictus::union([Type::INSTANCE, Type::STRING], new MyClass());

    expect($instanceValue->value)
        ->toBeInstanceOf(MyClass::class)
        ->and($instanceValue())
        ->toBeInstanceOf(MyClass::class);

    $enumValue = Strictus::union([Type::ENUM, Type::STRING], MyEnum::FOO);

    expect($enumValue->value)
        ->toBeInstanceOf(MyEnum::class)
        ->and($enumValue())
        ->toBeInstanceOf(MyEnum::class);
});

it('updates the value correctly', function () {
    $value = Strictus::union([Type::INT, Type::STRING], 'foo');

    expect($value->value)
        ->toBe('foo')
        ->and($value())
        ->toBe('foo');

    $value->value = 20;
    expect($value->value)
        ->toBe(20);

    $value(15);
    expect($value())
        ->toBe(15);

    $newValue = Strictus::union([Type::OBJECT, Type::INSTANCE], new MyClass());

    expect($newValue->value)
        ->toBeInstanceOf(MyClass::class)
        ->and($newValue())
        ->toBeInstanceOf(MyClass::class);

    $newValue->value = (object) ['foo' => 'bar'];
    expect($newValue->value)
        ->toEqual((object) ['foo' => 'bar']);

    $newValue((object) ['bar' => 'foo']);
    expect($newValue())
        ->toEqual((object) ['bar' => 'foo']);

    $nullValue = Strictus::nullableUnion([Type::ENUM, Type::INSTANCE], null);

    expect($nullValue->value)
        ->toEqual(null)
        ->and($nullValue())
        ->toEqual(null);

    $nullValue->value = new MyClass();
    expect($nullValue->value)
        ->toBeInstanceOf(MyClass::class);

    $nullValue(MyEnum::FOO);
    expect($nullValue->value)
        ->toBeInstanceOf(MyEnum::class)
        ->toBe(MyEnum::FOO);
});

it('can\'t updates the immutable value', function () {
    $value = Strictus::union([Type::INT, Type::STRING], 'foo')->immutable();

    expect($value->value)
        ->toEqual('foo')
        ->and($value())
        ->toEqual('foo')
        ->and(fn () => $value->value = 'bar')
        ->toThrow(ImmutableStrictusException::class)
        ->and(fn () => $value('bar'))
        ->toThrow(ImmutableStrictusException::class);
});
