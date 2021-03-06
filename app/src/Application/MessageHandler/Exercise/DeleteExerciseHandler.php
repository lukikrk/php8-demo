<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\Exercise;

use App\Application\Message\Exercise\DeleteExercise;
use App\Application\Repository\ExerciseRepositoryInterface;

class DeleteExerciseHandler
{
    public function __construct(private ExerciseRepositoryInterface $exerciseRepository)
    {}

    public function __invoke(DeleteExercise $deleteExercise): void
    {
        $exercise = $this->exerciseRepository->findExercise($deleteExercise->getId());

        $this->exerciseRepository->delete($exercise);
    }
}
