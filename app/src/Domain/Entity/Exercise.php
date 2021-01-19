<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Exercise\ExerciseName;
use Ramsey\Uuid\UuidInterface;

class Exercise
{
    public function __construct(
        private UuidInterface $id,
        private ExerciseName $name,
        private string $description,
        private ?User $user = null,
        private ?string $expertOpinion = null
    ) {}

    public function update(ExerciseName $name, string $description, ?string $expertOpinion): void
    {
        $this->name = $name;
        $this->description = $description;
        $this->expertOpinion = $expertOpinion;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): ExerciseName
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getExpertOpinion(): ?string
    {
        return $this->expertOpinion;
    }
}
