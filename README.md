<div align="center">
    <p>
        <img src="https://github.com/php-strictus/strictus/raw/main/art/logo.png" alt="Strictus" />
        <h1>Strictus</h1>
        Strict Typing on inline variables for PHP
    </p>

<p align="center">
<a href="https://packagist.org/packages/strictus/strictus"><img src="https://img.shields.io/packagist/v/strictus/strictus.svg?style=flat-square" alt="Packagist"></a>
<a href="https://packagist.org/packages/strictus/strictus"><img src="https://img.shields.io/packagist/php-v/strictus/strictus.svg?style=flat-square" alt="PHP from Packagist"></a>
<a href="https://github.com/php-strictus/strictus/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/php-strictus/strictus/tests.yml?branch=main&label=Tests"> </a>
</p>

<p align="center">
    <a href="#introduction">Introduction</a> |
    <a href="#installation">Installation</a> |
    <a href="#usage">Usage</a> |
    <a href="#credits">Credits</a> |
    <a href="#contributing">Contributing</a>
</p>
</div>

## Introduction

Following a discussion on Twitter between **[Christopher Miller](https://twitter.com/ccmiller2018)** and
**[Wendell Adriel](https://twitter.com/wendell_adriel)** around the lack of strongly typed inline variables
for PHP we quickly decided a package was the right approach whilst we could get an RFC into the core.

This is that package! you can now control the types of internal vars using a couple of different patterns.

For now, it is only single type or nullable single type, union types coming soon!

## Installation
You can install the package via composer:

```bash
composer require strictus/strictus
```

## Usage

There are a few different patterns you can use to work with this package.

### Creating Your Variables

You will need to use the `Strictus` class (`use Strictus\Strictus;`) in any class you wish to use this.

You can then strictly type a variable with any of the below methods:

| Type       | Nullable | Method                                            |
|------------|----------|---------------------------------------------------|
| String     | No       | Strictus::string($value)                          |
| String     | Yes      | Strictus::string($value, true)                    |
| String     | Yes      | Strictus::nullableString($value)                  |
| Integer    | No       | Strictus::int($value)                             |
| Integer    | Yes      | Strictus::int($value, true)                       |
| Integer    | Yes      | Strictus::nullableInt($value)                     |
| Float      | No       | Strictus::float($value)                           |
| Float      | Yes      | Strictus::float($value, true)                     |
| Float      | Yes      | Strictus::nullableFloat($value, true)             |
| Boolean    | No       | Strictus::boolean($value)                         |
| Boolean    | Yes      | Strictus::boolean($value, true)                   |
| Boolean    | Yes      | Strictus::nullableBoolean($value)                 |
| Array      | No       | Strictus::array($value)                           |
| Array      | Yes      | Strictus::array($value, true)                     |
| Array      | Yes      | Strictus::nullableArray($value)                   |
| Object     | No       | Strictus::object($value)                          |
| Object     | Yes      | Strictus::object($value, true)                    |
| Object     | Yes      | Strictus::nullableObject($value)                  |
| Class Type | No       | Strictus::instance($instanceType, $value)         |
| Class Type | Yes      | Strictus::instance($instanceType, $value, true)   |
| Class Type | Yes      | Strictus::nullableInstance($instanceType, $value) |

Once you have your typed variables created, you have two options on how to use them.

### Getting Variable Value

You can get the variable value using it like a function:

```php
$myString = Stricuts::string('Hello');

$myString(); // Hello
```

You can also use it like a Value Object:

```php
$myString = Stricuts::string('Hello');

$myString->value; // Hello
```

### Update Variable Value

You can update the variable value using it like a function:

```php
$myString = Stricuts::string('Hello');

$myString('Hello, world');
$myString(); // Hello, world
```

You can also use it like a Value Object:

```php
$myString = Stricuts::string('Hello');

$myString->value = 'Hello, world';
$myString->value; // Hello, world
```

### Error Handling

If you try to assign a value that doesn't match the type of the created variable, an
`Strictus\Exceptions\StrictusTypeException` exception will be thrown:

```php
$myString = Stricuts::string('Hello');

$myString(1); // StrictusTypeException
$myString->value = false; // StrictusTypeException
```

## Credits

- [Christopher Miller](https://github.com/chrisjumptwentyfour)
- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

Check the **[Contributing Guide](CONTRIBUTING.md)**.