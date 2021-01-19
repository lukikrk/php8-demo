<?php

declare(strict_types=1);

namespace App\Domain\ValueObject\Exercise;

use App\Domain\ValueObject\AbstractValueObject;
use InvalidArgumentException;

class ExerciseName extends AbstractValueObject
{
    public function __construct(string $value)
    {
        if (strlen($value) < 3) {
            throw new InvalidArgumentException('Exercise name too short.');
        }

        parent::__construct($value);
    }
}
