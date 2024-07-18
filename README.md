# PhpEntity

**A PHP package for hydrating entity objects from database rows.**

```php
$row = [
    'idTrail' => 1,
    'statusUrl' => 'http://example.com/status',
    'distance' => 12.34,
    'createdAt' => '2024-07-18 12:34:56',
    'updatedAt' => '2024-07-18 12:34:56',
];

$trailEntity = TrailEntity::createFromDatabaseRow($row);

echo $trailEntity->idTrail; // Outputs: 1
echo $trailEntity->statusUrl; // Outputs: http://example.com/status
```
