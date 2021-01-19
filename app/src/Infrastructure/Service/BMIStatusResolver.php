<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Enum\BMIStatus;

class BMIStatusResolver
{
    public function resolve(float $bmi): string
    {
        switch (true) {
            case $bmi < 16:
                return BMIStatus::STARVATION;
            case $bmi >= 16 && $bmi <= 16.99:
                return BMIStatus::EMACIATION;
            case $bmi >= 17 && $bmi <= 18.49:
                return BMIStatus::UNDERWEIGHT;
            case $bmi >= 18.5 && $bmi <= 24.99:
                return BMIStatus::OPTIMUM;
            case $bmi >= 25 && $bmi <= 29.99:
                return BMIStatus::OVERWEIGHT;
            case $bmi >= 30 && $bmi <= 34.99:
                return BMIStatus::OVERWEIGHT_1;
            case $bmi >= 35 && $bmi <= 39.99:
                return BMIStatus::OVERWEIGHT_2;
            case $bmi >= 40:
                return BMIStatus::OVERWEIGHT_3;
            default:
                return 'out of range';
        }
    }
}
