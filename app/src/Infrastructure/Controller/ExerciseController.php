<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Message\Exercise\CreateExercise;
use App\Application\Message\Exercise\DeleteExercise;
use App\Application\Message\Exercise\UpdateExercise;
use App\Application\Repository\ExerciseRepositoryInterface;
use App\Domain\Entity\Exercise;
use App\Infrastructure\DTO\Exercise\CreateExerciseRequest;
use App\Infrastructure\DTO\Exercise\UpdateExerciseRequest;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/exercises")
 */
class ExerciseController extends AbstractBaseController
{
    private ExerciseRepositoryInterface $exerciseRepository;

    public function __construct(
        ExerciseRepositoryInterface $exerciseRepository,
        MessageBusInterface $messageBus,
        SerializerInterface $serializer
    ) {
        $this->exerciseRepository = $exerciseRepository;

        parent::__construct($messageBus, $serializer);
    }


    /**
     * @Route(methods={"GET"})
     */
    public function list(): Response
    {
        return $this->jsonResponse($this->exerciseRepository->findAllExercises());
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function view(Exercise $exercise): Response
    {
        return $this->jsonResponse($exercise);
    }

    /**
     * @Route(methods={"POST"})
     */
    public function create(CreateExerciseRequest $request): Response
    {
        $createExercise = new CreateExercise(
            Uuid::uuid4()->toString(),
            $request->getName(),
            $request->getDescription(),
            $request->getUserId()
        );

        $envelope = $this->messageBus->dispatch($createExercise);

        return $this->responseFromEnvelope($envelope, Response::HTTP_CREATED);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise): Response
    {
        $updateExercise = new UpdateExercise(
            $exercise->getId()->toString(),
            $request->getName(),
            $request->getDescription()
        );

        $envelope = $this->messageBus->dispatch($updateExercise);

        return $this->responseFromEnvelope($envelope);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     */
    public function delete(Exercise $exercise): Response
    {
        $deleteExercise = new DeleteExercise($exercise->getId()->toString());

        $this->messageBus->dispatch($deleteExercise);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
