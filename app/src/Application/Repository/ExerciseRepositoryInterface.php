<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Entity\Exercise;

interface ExerciseRepositoryInterface
{
    public function findAllExercises(): array;

    public function findExercise(string $id): ?Exercise;

    public function save(Exercise $exercise): void;

    public function delete(Exercise $exercise): void;
}