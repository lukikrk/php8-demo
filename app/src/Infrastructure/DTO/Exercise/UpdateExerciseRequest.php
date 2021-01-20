<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO\Exercise;

use App\Infrastructure\DTO\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdateExerciseRequest implements RequestDTOInterface
{
    /**
     * @NotBlank()
     * @Length(min=3, max=255)
     */
    private ?string $name;

    /**
     * @NotBlank()
     */
    private ?string $description;

    public function __construct(Request $request)
    {
        $this->name = $request->get('name');
        $this->description = $request->get('description');
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
