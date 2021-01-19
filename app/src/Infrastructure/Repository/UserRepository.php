<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findAllUsers(): array
    {
        return parent::findAll();
    }

    public function findUser(string $id): ?User
    {
        return $this->find($id);
    }

    public function save(User $user): void
    {
        $this->_em->persist($user);
    }

    public function delete(User $user): void
    {
        $this->_em->remove($user);
    }
}
