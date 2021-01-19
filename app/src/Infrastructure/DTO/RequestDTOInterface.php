<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTOInterface
{
    public function __construct(Request $request);
}
