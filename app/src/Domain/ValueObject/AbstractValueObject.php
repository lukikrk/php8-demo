<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

abstract class AbstractValueObject
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
