<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'தலைக்கட்டு வரி (THALAIKATTU VARI)',
                'amount' => null,
                'display_order' => 1,
            ],
            [
                'name' => 'அன்னதான நன்கொடை (ANNADHAANAM DONATION)',
                'amount' => null,
                'display_order' => 2,
            ],
            [
                'name' => 'சம்பந்தக்காரர்கள் நன்கொடை (SAMBANTHAKAARAR DONATION)',
                'amount' => null,
                'display_order' => 3,
            ],
            [
                'name' => 'கட்டிட நன்கொடை (BUILDING DONATION)',
                'amount' => null,
                'display_order' => 4,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
