<?php

/**
 * AbstractEntity.
 *
 * @package PhpEntity
 * @license MIT https://github.com/SandroMiguel/php-entity/blob/master/LICENSE
 * @author Sandro Miguel Marques <sandromiguel@sandromiguel.com>
 * @link https://github.com/SandroMiguel/php-entity
 * @version 1.0.0 (2024-07-18)
 */

namespace PhpCore\Entity;

/**
 * Base class for entities.
 */
abstract class AbstractEntity
{
    /**
     * Creates an entity from a database row.
     *
     * @param array<string,int|string|null> $row Database row containing the entity data.
     *
     * @return static New instance with the data from the database row.
     */
    public static function createFromDatabaseRow(array $row): static
    {
        $reflection = new \ReflectionClass(static::class);
        $properties = $reflection->getProperties(
            \ReflectionProperty::IS_PUBLIC
        );

        $args = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyType = (string) $property->getType();

            $propertyTypeName = \strpos($propertyType, '?') === 0
                ? \substr($propertyType, 1)
                : $propertyType;

            $casterClass = 'PhpCaster\Types\\'
                . \ucfirst($propertyTypeName)
                . 'Caster';

            $args[$propertyName] = $casterClass::castOrNull(
                $row,
                $propertyName
            );
        }

        return new static(...$args);
    }
}
