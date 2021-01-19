<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\Exercise;

use App\Application\Message\Exercise\UpdateExercise;
use App\Application\Repository\ExerciseRepositoryInterface;
use App\Domain\Entity\Exercise;
use App\Domain\ValueObject\Exercise\ExerciseName;

class UpdateExerciseHandler
{
    private ExerciseRepositoryInterface $exerciseRepository;

    public function __construct(ExerciseRepositoryInterface $exerciseRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
    }

    public function __invoke(UpdateExercise $updateExercise): Exercise
    {
        $exercise = $this->exerciseRepository->findExercise($updateExercise->getId());

        $exercise->update(
            new ExerciseName($updateExercise->getName()),
            $updateExercise->getDescription(),
            $updateExercise->getExpertOpinion()
        );

        return $exercise;
    }
}
