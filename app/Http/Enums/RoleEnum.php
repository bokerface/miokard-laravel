<?php

namespace App\Http\Enums;

enum RoleEnum: string
{
    case ADMIN = 1;
    case PPDS = 2;
    case DOSEN = 3;

    public static function value(string $name): string
    {
        return constant(self::class . "::$name")->value;
    }
}
