<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Airline::create([
            'name' => 'Interjet',
            'code' => 'IJ-235',
        ]);

        Airline::create([
            'name' => 'Volaris',
            'code' => 'VL-133',
        ]);

        Airline::create([
            'name' => 'Vivabus',
            'code' => 'VB-111',
        ]);
    }
}
