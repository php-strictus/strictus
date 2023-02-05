<div align="center">
    <p>
        <img src="https://github.com/php-strictus/strictus/art/logo.png" alt="Strictus" />
        <h1>Strictus</h1>
        Strict Typing on inline variables for PHP
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

`composer require strictus/strictus`

## Usage

There are a few different patterns you can use to work with this package.

### Creating Your Variables

You will need to use the `Strictus` class (`use Strictus\Strictus;`) in any class you wish to use this

you can then strictly type a variable with any of the below methods:

| Type       | Nullable | Method                             |
|------------|----------|------------------------------------|
| String     | No       | Strictus::string($value)              |
| String     | Yes      | Strictus::string($value, true)        |
| String     | Yes      | Strictus::nullableString($value)      |
| Integer    | No       | Strictus::int($value)                 |
| Integer    | Yes      | Strictus::int($value, true)           |
| Integer    | Yes      | Strictus::nullableInt($value)         |
| Float      | No       | Strictus::float($value)               |
| Float      | Yes      | Strictus::float($value, true)         |
| Float      | Yes      | Strictus::nullableFloat($value, true) |
| Boolean    | No       | Strictus::boolean($value)             |
| Boolean    | Yes      | Strictus::boolean($value, true)       |
| Boolean    | Yes      | Strictus::nullableBoolean($value)     |
| Array      | No       | Strictus::array($value)               |
| Array      | Yes      | Strictus::array($value, true)         |
| Array      | Yes      | Strictus::nullableArray($value)       |
| Object     | No       | Strictus::object($value)              |
| Object     | Yes      | Strictus::object($value, true)        |
| Object     | Yes      | Strictus::nullableObject($value)      |
| Class Type | No       | Strictus::instance($value)            |
| Class Type | Yes      | Strictus::instance($value, true)      |
| Class Type | Yes      | Strictus::nullableInstance($value)    |

Once you have your typed variable created, you also have choices on how to use this.

### Function Like

```php
$myString = Strictus::nullableString('hello');

echo ($myString());

$myString('goodbye');
```

### Object Like

```php
$myString = Strictus::nullableString('hello');

echo ($myString->value);

$myString->value = 'goodbye';
```

Both of these forms will work for any of the types.

## Error Handling

When you are using this package, the package will throw a `TypeError` if you pass it a type that is not compatible with the intended conditions

## Credits

- [Christopher Miller](https://github.com/chrisjumptwentyfour)
- [Wendell Adriel](https://github.com/WendellAdriel)
- [All Contributors](../../contributors)

## Contributing

All PRs are welcome.

For major changes, please open an issue first describing what you want to add/change.