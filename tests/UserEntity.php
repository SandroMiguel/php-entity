<?php

/**
 * UserEntity.
 *
 * @package PhpEntity
 * @license MIT https://github.com/SandroMiguel/php-entity/blob/master/LICENSE
 * @author Sandro Miguel Marques <sandromiguel@sandromiguel.com>
 * @link https://github.com/SandroMiguel/php-entity
 * @version 1.1.0 (2026-03-17)
 */

declare(strict_types=1);

namespace PhpEntity\Tests;

use PhpEntity\AbstractEntity;

/**
 * Class UserEntity
 *
 * A concrete implementation of AbstractEntity for testing purposes.
 */
class UserEntity extends AbstractEntity
{
    /**
     * Constructor.
     *
     * @param int|null $idUser User ID.
     * @param string|null $username User name.
     * @param string|null $email User email.
     * @param array<int,string|null> $bios User bios (multilingual).
     * @param \DateTimeImmutable|null $createdAt User creation date.
     * @param \DateTimeImmutable|null $updatedAt User update date.
     */
    public function __construct(
        public ?int $idUser = null,
        public ?string $username = null,
        public ?string $email = null,
        public array $bios = [],
        public ?\DateTimeImmutable $createdAt = null,
        public ?\DateTimeImmutable $updatedAt = null,
    ) {}
}
