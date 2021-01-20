<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO\Exercise;

use App\Infrastructure\DTO\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateExerciseRequest implements RequestDTOInterface
{
    /**
     * @NotBlank()
     * @Assert\Length(min=3, max=255)
     */
    private ?string $name;

    /**
     * @NotBlank()
     */
    private ?string $description;

    /**
     * @NotBlank()
     */
    private ?string $userId;

    public function __construct(Request $request)
    {
        $this->name = $request->get('name');
        $this->description = $request->get('description');
        $this->userId = $request->get('userId');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }
}
