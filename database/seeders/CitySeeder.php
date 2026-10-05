<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Ariyalur',
            'Chengalpattu',
            'Chennai',
            'Coimbatore',
            'Cuddalore',
            'Dharmapuri',
            'Dindigul',
            'Erode',
            'Kallakurichi',
            'Kancheepuram',
            'Karur',
            'Krishnagiri',
            'Madurai',
            'Mayiladuthurai',
            'Nagapattinam',
            'Namakkal',
            'Nilgiris',
            'Perambalur',
            'Pudukkottai',
            'Ramanathapuram',
            'Ranipet',
            'Salem',
            'Sivaganga',
            'Tenkasi',
            'Thanjavur',
            'Theni',
            'Thoothukudi',
            'Tiruchirappalli',
            'Tirunelveli',
            'Tirupathur',
            'Tiruppur',
            'Tiruvallur',
            'Tiruvarur',
            'Vellore',
            'Viluppuram',
            'Virudhunagar',
        ];

        foreach ($cities as $city) {
            City::create([
                'name' => $city,
                'status' => true,
            ]);
        }
    }
}
