<?php

declare(strict_types=1);

namespace App\Application\Message\User;

class UpdateUser
{
    private string $id;

    private string $firstName;

    private string $lastName;

    private float $height;

    private float $weight;

    private string $street;

    private string $zip;

    private string $city;

    private ?string $country;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        float $height,
        float $weight,
        string $street,
        string $zip,
        string $city,
        ?string $country
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->height = $height;
        $this->weight = $weight;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getHeight(): float
    {
        return $this->height;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}
