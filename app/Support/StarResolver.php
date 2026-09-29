<?php

namespace App\Support;

use App\Models\Star;

class StarResolver
{
    protected static ?array $map = null;


    protected static function map(): array
    {
        if (self::$map !== null) {
            return self::$map;
        }

        self::$map = [];

        $stars = Star::all()->keyBy('name');

        foreach (config('stars') as $official => $aliases) {

            if (!isset($stars[$official])) {
                continue;
            }

            // Official name
            self::$map[self::normalize($official)] = $stars[$official];

            // Aliases
            foreach ($aliases as $alias) {
                self::$map[self::normalize($alias)] = $stars[$official];
            }
        }

        return self::$map;
    }
    public static function resolve(?string $value): ?Star
    {
        if (blank($value)) {
            return null;
        }

        return self::map()[self::normalize($value)] ?? null;
    }


    /**
     * Normalize star name.
     */
    private static function normalize(string $value): string
    {
        $value = trim($value);

        // Convert multiple spaces to single space
        $value = preg_replace('/\s+/u', ' ', $value);

        // Remove leading/trailing spaces
        $value = trim($value);

        // Remove common separators
        $value = str_replace([
            '.',
            ',',
            '-',
            '_',
            '(',
            ')',
            '/',
            '\\',
            ':',
            ';',
        ], '', $value);

        // Remove all spaces
        $value = str_replace(' ', '', $value);

        // Remove pada numbers
        // Examples:
        // ரோகிணி1
        // ரோகிணி2
        // ரோகிணி3
        // ரோகிணி4
        $value = preg_replace('/[1-4]$/u', '', $value);

        return mb_strtolower($value, 'UTF-8');
    }
}
