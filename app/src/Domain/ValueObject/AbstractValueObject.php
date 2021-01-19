<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class AbstractValueObject
{
    public function __construct(protected mixed $value)
    {}

    public function getValue(): mixed
    {
        return $this->value;
    }
}
