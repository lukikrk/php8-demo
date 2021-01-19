<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\Exercise;

use App\Application\Message\Exercise\CreateExercise;
use App\Application\Repository\ExerciseRepositoryInterface;
use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\Exercise;
use App\Domain\ValueObject\Exercise\ExerciseName;
use Ramsey\Uuid\Uuid;

class CreateExerciseHandler
{
    private ExerciseRepositoryInterface $exerciseRepository;

    private UserRepositoryInterface $userRepository;

    public function __construct(
        ExerciseRepositoryInterface $exerciseRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->exerciseRepository = $exerciseRepository;
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateExercise $createExercise): Exercise
    {
        $exercise = new Exercise(
            Uuid::fromString($createExercise->getId()),
            new ExerciseName($createExercise->getName()),
            $createExercise->getDescription(),
            $this->userRepository->findUser($createExercise->getUserId()),
            $createExercise->getExpertOpinion()
        );

        $this->exerciseRepository->save($exercise);

        return $exercise;
    }
}
