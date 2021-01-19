<?php

declare(strict_types=1);

namespace App\Domain\Enum;

class BMIStatus
{
    public const STARVATION = 'starvation';
    public const EMACIATION = 'emaciation';
    public const UNDERWEIGHT = 'underweight';
    public const OPTIMUM = 'optimum';
    public const OVERWEIGHT = 'overweight';
    public const OVERWEIGHT_1 = 'obesity lvl 1';
    public const OVERWEIGHT_2 = 'obesity lvl 2';
    public const OVERWEIGHT_3 = 'obesity lvl3';
}
