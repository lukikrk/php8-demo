<?php

declare(strict_types=1);

namespace App\Application\Message\Exercise;

class UpdateExercise
{
    private string $id;

    private string $name;

    private string $description;

    private ?string $expertOpinion;

    public function __construct(
        string $id,
        string $name,
        string $description,
        ?string $expertOpinion = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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

    public function getExpertOpinion(): ?string
    {
        return $this->expertOpinion;
    }
}
