# Strictus
Following a discussion on twitter between Christopher Miller and Wendell Adriel around the lack of strongly typed internal variables for PHP
we quickly decided a package was the right approach whilst we could get an RFC into the core.

This is that package! you can now control the types of internal vars using a couple of different patterns.

For now, it is only single type or nullable single type, union types coming soon!

## Installation
You can install the package via composer:

`composer require strictus/strictus`

This is set to use PHP 8.1+ in line with the current active versions shown on [php.net](https://www.php.net/supported-versions.php)

## Usage

There are a few different patterns you can use for this package.

### Creating Your Variable

You will need to use the Typed class (`use Strictus\Strictus\Typed;`) in any class you wish to use this

you can then strictly type a variable with any of the below methods:

| Type       | Nullable | Method                             |
|------------|----------|------------------------------------|
| String     | No       | Typed::string($value)              |
| String     | Yes      | Typed::string($value, true)        |
| String     | Yes      | Typed::nullableString($value)      |
| Integer    | No       | Typed::int($value)                 |
| Integer    | Yes      | Typed::int($value, true)           |
| Integer    | Yes      | Typed::nullableInt($value)         |
| Float      | No       | Typed::float($value)               |
| Float      | Yes      | Typed::float($value, true)         |
| Float      | Yes      | Typed::nullableFloat($value, true) |
| Boolean    | No       | Typed::boolean($value)             |
| Boolean    | Yes      | Typed::boolean($value, true)       |
| Boolean    | Yes      | Typed::nullableBoolean($value)     |
| Array      | No       | Typed::arr($value)                 |
| Array      | Yes      | Typed::arr($value, true)           |
| Array      | Yes      | Typed::nullableArr($value)         |
| Object     | No       | Typed::object($value)              |
| Object     | Yes      | Typed::object($value, true)        |
| Object     | Yes      | Typed::nullableObject($value)      |
| Class Type | No       | Typed::instance($value)            |
| Class Type | Yes      | Typed::instance($value, true)      |
| Class Type | Yes      | Typed::nullableInstance($value)    |

Once you have your typed variable created, you also have choices on how to use this.

### Function Like

```php
$myString = Typed::nullableString('hello');

echo ($myString());

$myString('goodbye');
```

### Object Like

```php
$myString = Typed::nullableString('hello');

echo ($myString->value);

$myString->value = 'goodbye';
```

Both of these forms will work for any of the types.

## Error Reporting

When you are using this package, the package will throw a `TypeError` if you pass it a type that is not compatible with the intended conditions

## Changelog

## 1.0.0

### Added

1) Each of the primitive types for PHP
2) Nullable functionality

Contributing
Please see CONTRIBUTING for details.

Security Vulnerabilities
Please review our security policy on how to report security vulnerabilities.

Credits
:author_name
All Contributors
License
The MIT License (MIT). Please see License File for more information.