<?php

declare(strict_types=1);

namespace App\Application\Message\Exercise;

class UpdateExercise
{
    public function __construct(
        private string $id,
        private string $name,
        private string $description,
        private ?string $expertOpinion = null
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getExpertOpinion(): ?string
    {
        return $this->expertOpinion;
    }
}
