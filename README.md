# PhpEntity

**A PHP package for efficiently hydrating entity objects from arrays, database results, or API payloads.**

## Overview

PhpEntity provides a simple and powerful way to transform associative arrays into fully-typed PHP objects.

At its core is the `AbstractEntity` class, which uses reflection and type casting to automatically map array data into entity properties.

It also includes built-in support for multilingual fields, allowing you to define translations using a simple naming convention.

## Features

- Automatic entity hydration from arrays
- Strong typing with automatic casting via `PhpCaster`
- Native support for `DateTimeImmutable`
- Built-in multilingual field handling
- Zero configuration required

## Installation

To include PhpEntity in your project, add the following line to your `composer.json` file:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:SandroMiguel/php-entity.git"
    }
],
```

Then, require the package in your `composer.json` file:

```json
"require": {
    "sandromiguel/php-entity": "dev-main"
}
```

Afterward, run `composer update` to download the package.

## Usage

### Step 1: Define your entity classes extending the `AbstractEntity` class:

```php
class UserEntity extends AbstractEntity
{
    public function __construct(
        public ?int $idUser = null,
        public ?string $username = null,
        public ?string $email = null,
        public array $bios = [],
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $updatedAt = null
    ) {}
}
```

### Step 2: Use the hydrate method of your entity class to populate an instance with data from an array:

```php
// Sample data from a database query, API payload, or simple array
$row = [
    'idUser' => 1,
    'username' => 'john_doe',
    'email' => 'john_doe@example.com',
    'createdAt' => '2024-07-18 12:34:56',
    'updatedAt' => '2024-07-18 12:34:56',
];

// Hydrate the entity
$trailEntity = TrailEntity::hydrate($row);

echo $trailEntity->idUser; // Outputs: 1
echo $trailEntity->username; // Outputs: john_doe
```

### Multilingual Fields

PhpEntity supports multilingual properties out of the box using a simple naming convention.

#### Input format

Use the pattern:

```php
field_locale
```

where `field` is the name of the field and `locale` is the language code (language ID).

#### Example

```php
$data = [
    'bio_1' => 'Caminhante português',
    'bio_3' => 'Portuguese hiker',
]
```

#### Result

```php
$userEntity = UserEntity::hydrate($data);

echo $userEntity->bios[1]; // Outputs: Caminhante português
echo $userEntity->bios[3]; // Outputs: Portuguese hiker
```
