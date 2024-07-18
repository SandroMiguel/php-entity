<?php

/**
 * AbstractEntityTest.
 *
 * @package PhpEntity
 * @license MIT https://github.com/SandroMiguel/php-entity/blob/master/LICENSE
 * @author Sandro Miguel Marques <sandromiguel@sandromiguel.com>
 * @link https://github.com/SandroMiguel/php-entity
 * @version 1.0.0 (2024-07-18)
 */

declare(strict_types=1);

namespace PhpCaster\Types;

use PhpEntity\Tests\UserEntity;
use PHPUnit\Framework\TestCase;

/**
 * Tests the AbstractEntity class.
 */
class AbstractEntityTest extends TestCase
{
    /**
     * Tests the hydrate method of AbstractEntity.
     *
     * Ensures that the hydrate method correctly instantiates an entity
     * with the provided data.
     */
    public function testHydrate(): void
    {
        $data = [
            'idUser' => 1,
            'username' => 'john_doe',
            'email' => 'john_doe@example.com',
            'createdAt' => '2024-07-18 12:34:56',
            'updatedAt' => '2024-07-18 12:34:56',
        ];

        $userEntity = UserEntity::hydrate($data);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertSame(1, $userEntity->idUser);
        $this->assertSame('john_doe', $userEntity->username);
        $this->assertSame('john_doe@example.com', $userEntity->email);
        $this->assertEquals(
            new \DateTimeImmutable('2024-07-18 12:34:56'),
            $userEntity->createdAt
        );
        $this->assertEquals(
            new \DateTimeImmutable('2024-07-18 12:34:56'),
            $userEntity->updatedAt
        );
    }

    /**
     * Tests the hydrate method with null values.
     *
     * Ensures that the hydrate method correctly handles null values.
     */
    public function testHydrateWithNullValues(): void
    {
        $data = [
            'idUser' => 1,
            'username' => 'john_doe',
            'email' => 'john_doe@example.com',
            'createdAt' => null,
            'updatedAt' => null,
        ];

        $userEntity = UserEntity::hydrate($data);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertSame(1, $userEntity->idUser);
        $this->assertSame('john_doe', $userEntity->username);
        $this->assertSame('john_doe@example.com', $userEntity->email);
        $this->assertNull($userEntity->createdAt);
        $this->assertNull($userEntity->updatedAt);
    }

    /**
     * Tests the hydrate method with missing values.
     *
     * Ensures that the hydrate method correctly handles missing values.
     */
    public function testHydrateWithMissingValues(): void
    {
        $data = [
            'idUser' => 1,
            'username' => 'john_doe',
        ];

        $userEntity = UserEntity::hydrate($data);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertSame(1, $userEntity->idUser);
        $this->assertSame('john_doe', $userEntity->username);
        $this->assertNull($userEntity->email);
        $this->assertNull($userEntity->createdAt);
        $this->assertNull($userEntity->updatedAt);
    }

    /**
     * Tests the hydrate method with incorrect data types.
     *
     * Ensures that the hydrate method correctly handles incorrect data types,
     * returning null for properties with invalid types.
     */
    public function testHydrateWithIncorrectTypes(): void
    {
        $data = [
            'idUser' => 'hello', // Should be integer, but is string
            'username' => 'john_doe',
            'email' => 'john_doe@example.com',
            'createdAt' => '2024-07-18 12:34:56',
            'updatedAt' => '2024-07-18 12:34:56',
        ];

        $userEntity = UserEntity::hydrate($data);

        $this->assertInstanceOf(UserEntity::class, $userEntity);
        $this->assertSame(null, $userEntity->idUser); // Expecting null for incorrect type
        $this->assertSame('john_doe', $userEntity->username);
        $this->assertSame('john_doe@example.com', $userEntity->email);
        $this->assertEquals(
            new \DateTimeImmutable('2024-07-18 12:34:56'),
            $userEntity->createdAt
        );
        $this->assertEquals(
            new \DateTimeImmutable('2024-07-18 12:34:56'),
            $userEntity->updatedAt
        );
    }
}
