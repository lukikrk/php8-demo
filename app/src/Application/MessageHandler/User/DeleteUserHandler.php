<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\User;

use App\Application\Message\User\DeleteUser;
use App\Application\Repository\UserRepositoryInterface;

class DeleteUserHandler
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(DeleteUser $deleteUser): void
    {
        $user = $this->userRepository->findUser($deleteUser->getId());

        $this->userRepository->delete($user);
    }
}
