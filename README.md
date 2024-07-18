# PhpEntity

**A PHP package for efficiently populating entity objects from database query results, API payloads, or simple arrays.**

## Overview

PhpEntity is a PHP package designed to streamline the creation of entity objects from arrays. It includes `AbstractEntity`, an abstract class that simplifies the instantiation of entity objects by populating them with data from arrays. This package facilitates efficient object hydration from various sources such as database query results, API payloads, or simple arrays, making it versatile for a wide range of PHP applications.

## Usage

### Step 1: Define your entity classes extending the `AbstractEntity` class:

```php
class UserEntity extends AbstractEntity
{
    public function __construct(
        public ?int $idUser = null,
        public ?string $username = null,
        public ?string $email = null,
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
