<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Enum\BMIStatus;

class BMIStatusResolver
{
    public function resolve(float $bmi): string
    {
        return match (true) {
            $bmi < 16 => BMIStatus::STARVATION,
            $bmi >= 16 && $bmi <= 16.99 => BMIStatus::EMACIATION,
            $bmi >= 17 && $bmi <= 18.49 => BMIStatus::UNDERWEIGHT,
            $bmi >= 18.5 && $bmi <= 24.99 => BMIStatus::OPTIMUM,
            $bmi >= 25 && $bmi <= 29.99 => BMIStatus::OVERWEIGHT,
            $bmi >= 30 && $bmi <= 34.99 => BMIStatus::OVERWEIGHT_1,
            $bmi >= 35 && $bmi <= 39.99 => BMIStatus::OVERWEIGHT_2,
            $bmi >= 40 => BMIStatus::OVERWEIGHT_3,
            default => 'out of range'
        };
    }
}
