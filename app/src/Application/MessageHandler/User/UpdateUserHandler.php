<?php

declare(strict_types=1);

namespace App\Application\MessageHandler\User;

use App\Application\Message\User\UpdateUser;
use App\Application\Repository\UserRepositoryInterface;
use App\Domain\Entity\Address;
use App\Domain\Entity\User;

class UpdateUserHandler
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function __invoke(UpdateUser $updateUser): User
    {
        $user = $this->userRepository->findUser($updateUser->getId());

        $address = $user->getAddress();

        if (!$address) {
            $address = new Address(
                $updateUser->getStreet(),
                $updateUser->getZip(),
                $updateUser->getCity(),
                $updateUser->getCountry()
            );
        } else {
            $address->update(
                $updateUser->getStreet(),
                $updateUser->getZip(),
                $updateUser->getCity(),
                $updateUser->getCountry()
            );
        }

        $user->update(
            $updateUser->getFirstName(),
            $updateUser->getLastName(),
            $updateUser->getHeight(),
            $updateUser->getWeight(),
            $address
        );

        return $user;
    }
}
