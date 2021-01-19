<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Repository\ExerciseRepositoryInterface;
use App\Domain\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExerciseRepository extends ServiceEntityRepository implements ExerciseRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    public function findAllExercises(): array
    {
        return $this->findAll();
    }

    public function findExercise(string $id): ?Exercise
    {
        return $this->find($id);
    }

    public function save(Exercise $exercise): void
    {
        $this->_em->persist($exercise);
    }

    public function delete(Exercise $exercise): void
    {
        $this->_em->remove($exercise);
    }
}
