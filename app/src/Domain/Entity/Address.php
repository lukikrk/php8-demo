<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Address
{
    private string $street;

    private string $zip;

    private string $city;

    private ?string $country;

    public function __construct(string $street, string $zip, string $city, ?string $country)
    {
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
    }

    public function update(string $street, string $zip, string $city, ?string $country): void
    {
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->country = $country;
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
