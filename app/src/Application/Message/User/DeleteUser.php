<?php

declare(strict_types=1);

namespace App\Application\Message\User;

class DeleteUser
{
    public function __construct(private string $id)
    {}

    public function getId(): string
    {
        return $this->id;
    }
}
