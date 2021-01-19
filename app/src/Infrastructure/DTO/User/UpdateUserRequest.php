<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO\User;

use App\Infrastructure\DTO\RequestDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdateUserRequest implements RequestDTOInterface
{
    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $firstName;

    #[NotBlank]
    #[Length(min: 3, max: 255)]
    private ?string $lastName;

    #[NotBlank]
    private ?float $height;

    #[NotBlank]
    private ?float $weight;

    #[NotBlank]
    private ?string $street;

    #[NotBlank]
    private ?string $zip;

    #[NotBlank]
    private ?string $city;

    private ?string $country;

    public function __construct(Request $request)
    {
        $this->firstName = $request->get('firstName');
        $this->lastName = $request->get('lastName');
        $this->height = $request->get('height');
        $this->weight = $request->get('weight');
        $this->street= $request->get('street');
        $this->zip = $request->get('zip');
        $this->city = $request->get('city');
        $this->country = $request->get('country');
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}
