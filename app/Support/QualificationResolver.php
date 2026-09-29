<?php

namespace App\Support;

use App\Models\EducationQualification;

class QualificationResolver
{
    protected static ?array $map = null;


    private static function normalize(string $value): string
    {
        $value = strtoupper(trim($value));

        // Remove spaces
        $value = preg_replace('/\s+/u', '', $value);

        // Remove dots
        $value = str_replace('.', '', $value);

        return $value;
    }

    protected static function map(): array
    {
        if (self::$map !== null) {
            return self::$map;
        }

        self::$map = [];

        $qualifications = EducationQualification::all();

        foreach ($qualifications as $qualification) {

            self::$map[self::normalize($qualification->name)] = $qualification;

        }

        return self::$map;
    }

    public static function resolve(?string $value): ?EducationQualification
    {
        if (blank($value)) {
            return null;
        }

        $normalized = self::normalize($value);

        if (isset(self::map()[$normalized])) {

            return self::map()[$normalized];

        }

        // Create new qualification
        $qualification = EducationQualification::create([
            'name' => trim($value),
        ]);

        // Add it to memory
        self::$map[$normalized] = $qualification;

        return $qualification;
    }
}
