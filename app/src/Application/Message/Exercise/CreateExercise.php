<?php

declare(strict_types=1);

namespace App\Application\Message\Exercise;

class CreateExercise
{
    private string $id;

    private string $name;

    private string $description;

    private string $userId;

    private ?string $expertOpinion;

    public function __construct(
        string $id,
        string $name,
        string $description,
        string $userId,
        ?string $expertOpinion = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->userId = $userId;
        $this->expertOpinion = $expertOpinion;
    }


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

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getExpertOpinion(): ?string
    {
        return $this->expertOpinion;
    }
}
