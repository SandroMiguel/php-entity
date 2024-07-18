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

declare(strict_types=1);

namespace PhpEntity;

/**
 * Base class for entities.
 */
abstract class AbstractEntity
{
    /**
     * Hydrates an entity with data from an array.
     *
     * @param array<string,int|string|null> $properties Array containing the
     *  entity properties. This array can typically be obtained from a database
     *  query result or an API payload.
     *
     * @return static New instance with the data from the database row.
     */
    public static function hydrate(array $properties): static
    {
        $reflection = new \ReflectionClass(static::class);
        $reflectionProperties = $reflection->getProperties(
            \ReflectionProperty::IS_PUBLIC
        );

        $args = [];
        foreach ($reflectionProperties as $property) {
            $propertyName = $property->getName();
            $propertyType = (string) $property->getType();

            $propertyTypeName = \strpos($propertyType, '?') === 0
                ? \substr($propertyType, 1)
                : $propertyType;

            $casterClass = 'PhpCaster\Types\\'
                . \ucfirst($propertyTypeName)
                . 'Caster';

            $args[$propertyName] = $casterClass::castOrNull(
                $properties,
                $propertyName
            );
        }

        return $reflection->newInstanceArgs($args);
    }
}
