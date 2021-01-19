<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Message\User\CreateUser;
use App\Application\Message\User\DeleteUser;
use App\Application\Message\User\UpdateUser;
use App\Application\Repository\UserRepositoryInterface;
use App\Infrastructure\DTO\User\CreateUserRequest;
use App\Infrastructure\DTO\User\UpdateUserRequest;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/users")]
class UserController extends AbstractBaseController
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        MessageBusInterface $messageBus,
        SerializerInterface $serializer
    ) {
        parent::__construct($messageBus, $serializer);
    }

    #[Route(methods: ["GET"])]
    public function list(): Response
    {
        return $this->jsonResponse($this->userRepository->findAllUsers());
    }

    #[Route("/{id}", methods: ["GET"])]
    public function view(string $id): Response
    {
        if (!$this->userRepository->findUser($id)) {
            throw new NotFoundHttpException();
        }

        return $this->jsonResponse($this->userRepository->findUser($id));
    }

    #[Route(methods: ["POST"])]
    public function create(CreateUserRequest $request): Response
    {
        $createUser = new CreateUser(
            Uuid::uuid4()->toString(),
            $request->getFirstName(),
            $request->getLastName(),
            $request->getHeight(),
            $request->getWeight(),
            $request->getStreet(),
            $request->getZip(),
            $request->getCity(),
            $request->getCountry(),
        );

        $envelope = $this->messageBus->dispatch($createUser);

        return $this->responseFromEnvelope($envelope, Response::HTTP_CREATED);
    }

    #[Route("/{id}", methods: ["PUT"])]
    public function update(UpdateUserRequest $request, string $id): Response
    {
        if (!$this->userRepository->findUser($id)) {
            throw new NotFoundHttpException();
        }

        $updateUser = new UpdateUser(
            $id,
            $request->getFirstName(),
            $request->getLastName(),
            $request->getHeight(),
            $request->getWeight(),
            $request->getStreet(),
            $request->getZip(),
            $request->getCity(),
            $request->getCountry(),
        );

        $envelope = $this->messageBus->dispatch($updateUser);

        return $this->responseFromEnvelope($envelope);
    }

    #[Route("/{id}", methods: ["DELETE"])]
    public function delete(string $id): Response
    {
        if (!$this->userRepository->findUser($id)) {
            throw new NotFoundHttpException();
        }

        $deleteUser = new DeleteUser($id);

        $this->messageBus->dispatch($deleteUser);

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
