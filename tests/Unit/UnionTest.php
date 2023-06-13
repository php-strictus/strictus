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

    $instanceValue = Strictus::union([Type::INSTANCE, Type::STRING], new MyDummyClass());

    expect($instanceValue->value)
        ->toBeInstanceOf(MyDummyClass::class)
        ->and($instanceValue())
        ->toBeInstanceOf(MyDummyClass::class);

    $enumValue = Strictus::union([Type::ENUM, Type::STRING], MyDummyBackedEnum::BAR);

    expect($enumValue->value)
        ->toBeInstanceOf(MyDummyBackedEnum::class)
        ->and($enumValue())
        ->toBeInstanceOf(MyDummyBackedEnum::class);
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

    $newValue = Strictus::union([Type::OBJECT, Type::INSTANCE], new MyDummyClass());

    expect($newValue->value)
        ->toBeInstanceOf(MyDummyClass::class)
        ->and($newValue())
        ->toBeInstanceOf(MyDummyClass::class);

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

    $nullValue->value = new MyDummyClass();
    expect($nullValue->value)
        ->toBeInstanceOf(MyDummyClass::class);

    $nullValue(MyDummyEnum::FOO);
    expect($nullValue->value)
        ->toBeInstanceOf(MyDummyEnum::class)
        ->toBe(MyDummyEnum::FOO);
});

it('can\'t updates the instanceable value', function () {
    $value = Strictus::union([Type::ENUM, Type::BOOLEAN], MyDummyBackedEnum::BAR);

    expect($value->value)
        ->toBeInstanceOf(MyDummyBackedEnum::class)
        ->toBe(MyDummyBackedEnum::BAR)
        ->and($value())
        ->toEqual(MyDummyBackedEnum::BAR)
        ->toBeInstanceOf(MyDummyBackedEnum::class)
        ->toBe(MyDummyBackedEnum::BAR)
        ->and(fn () => $value->value = MyDummyEnum::FOO)
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => $value(MyDummyEnum::FOO))
        ->toThrow(StrictusTypeException::class);

    $newValue = Strictus::union([Type::INSTANCE, Type::BOOLEAN], new MyDummyClass());

    expect($newValue->value)
        ->toBeInstanceOf(MyDummyClass::class)
        ->and($newValue())
        ->toBeInstanceOf(MyDummyClass::class)
        ->and(fn () => $newValue->value = new MySecondDummyClass())
        ->toThrow(StrictusTypeException::class)
        ->and(fn () => $newValue(new MySecondDummyClass()))
        ->toThrow(StrictusTypeException::class);
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

class MyDummyClass
{
}

class MySecondDummyClass
{
}

enum MyDummyEnum
{
    case FOO;
}

enum MyDummyBackedEnum: int
{
    case BAR = 1;
}
