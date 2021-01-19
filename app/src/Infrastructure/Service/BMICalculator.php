<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

class BMICalculator
{
    public function calculate(float $weight, float $height): float
    {
        $height = $height / 100;

        return $weight / ($height * $height);
    }
}
