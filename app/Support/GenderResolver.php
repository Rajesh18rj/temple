<?php

namespace App\Support;

use App\Models\Gender;

class GenderResolver
{
    protected static ?array $map = null;

    protected static function map(): array
    {
        if (self::$map !== null) {
            return self::$map;
        }

        self::$map = [];

        $genders = Gender::all()->keyBy(function ($gender) {
            return strtolower(trim($gender->name));
        });

        foreach ($genders as $key => $gender) {
            self::$map[$key] = $gender;
        }

        return self::$map;
    }

    public static function resolve(?string $value): ?Gender
    {
        if (blank($value)) {
            return null;
        }

        return self::map()[self::normalize($value)] ?? null;
    }

    private static function normalize(string $value): string
    {
        return strtolower(trim($value));
    }
}
