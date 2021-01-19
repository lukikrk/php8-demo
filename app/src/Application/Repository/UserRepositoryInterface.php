<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findAllUsers(): array;

    public function findUser(string $id): ?User;

    public function save(User $user): void;

    public function delete(User $user): void;
}
