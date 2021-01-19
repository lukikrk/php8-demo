<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\User;

use App\Application\Message\User\CreateUser;
use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\Address;
use App\Domain\Entity\User;
use Ramsey\Uuid\Uuid;

class CreateUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(CreateUser $createUser): User
    {
        $address = new Address(
            $createUser->getStreet(),
            $createUser->getZip(),
            $createUser->getCity(),
            $createUser->getCountry()
        );

        $user = new User(
            Uuid::fromString($createUser->getId()),
            $createUser->getFirstName(),
            $createUser->getLastName(),
            $createUser->getHeight(),
            $createUser->getWeight(),
            $address
        );

        $this->userRepository->save($user);

        return $user;
    }
}
