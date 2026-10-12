<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'ALANGANALLUR',
            'ANDAMAN',
            'ANDIPATTI',
            'ANDHRA',
            'BATTALAGUNDU',
            'BENGALURU',
            'BODI',
            'CHENNAI',
            'CHOZHAVANDAN',
            'COIMBATORE',
            'DHARMATHUPATTI',
            'DINDIGUL',
            'ERODE',
            'HASAN',
            'HOSUR',
            'KANNIYAPPA PILAI PATTI',
            'KATHAKINARU',
            'KODAIKANAL',
            'KOOTHIPARAI',
            'KURIVITHURAI',
            'KRUVITHURAI',
            'MADURAI',
            'MALANGKINARU',
            'MYSORE',
            'OTHAKADAI',
            'PALADAM',
            'PARAVAI',
            'PERIYAKULAM',
            'PUNE',
            'PUTHUTHAMARAI PATTI',
            'RAJAPALAYAM',
            'RAMNAD',
            'SATHUR',
            'SIVAKASI',
            'SINTHALAKARAI',
            'SRIVILLIPUTHUR',
            'THANDALAI',
            'THANJAVUR',
            'THENI',
            'TIRUNELVELI',
            'TIRUPPUR',
            'TRICHY',
            'TUTICORIN',
            'TUTUICORIN',
            'USILAMPATTI',
            'USA',
            'VEDACHANDUR',
            'VIJAYAWADA',
            'VIRUDHUNAGAR',
        ];

        foreach ($cities as $city) {
            City::updateOrCreate(
                ['name' => $city],
                ['status' => true]
            );
        }
    }
}
