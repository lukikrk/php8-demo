<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class User
{
    private UuidInterface $id;

    private string $firstName;

    private string $lastName;

    private $height;

    private $weight;

    private ?Address $address;

    public function __construct(
        UuidInterface $id,
        string $firstName,
        string $lastName,
        $height,
        $weight,
        ?Address $address = null
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->height = $height;
        $this->weight = $weight;
        $this->address = $address;
    }

    public function update(string $firstName, string $lastName, float $height, float $weight, Address $address): void
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->height = $height;
        $this->weight = $weight;
        $this->address = $address;
    }

    public function getId(): UuidInterface
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

    public function getHeight()
    {
        return $this->height;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}