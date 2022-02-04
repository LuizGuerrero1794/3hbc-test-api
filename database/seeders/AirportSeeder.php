<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airport::create([
            "name" => "Aeropuerto de Cancún",
            "code" => "CUNA1",
            "city" => "Cancún",
        ]);

        Airport::create([
            "name" => "Aeropuerto de Ciudad de México",
            "code" => "MXA1",
            "city" => "Ciudad de México",
        ]);
    }
}
