<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

class User
{
    public function __construct(
        private UuidInterface $id,
        private string $firstName,
        private string $lastName,
        private int|float $height,
        private int|float $weight,
        private ?Address $address = null
    ) {}

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

    public function getHeight(): float|int
    {
        return $this->height;
    }

    public function getWeight(): float|int
    {
        return $this->weight;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}