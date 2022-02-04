<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flight::create([
            'code' => 'FLY-2244',
            'type' => 'PASSENGER', //FREIGHT
            'departure_id' => 1,
            'destination_id' => 1,
            'airline_id' => 1,
            'departure_time' => Carbon::now()->format('H:i:s'),
            'arrival_time' => Carbon::now()->format('H:i:s'),
        ]);      
        Flight::create([
            'code' => 'FLY-2565',
            'type' => 'FREIGHT',
            'departure_id' => 1,
            'destination_id' => 1,
            'airline_id' => 2,
            'departure_time' => Carbon::now()->format('H:i:s'),
            'arrival_time' => Carbon::now()->format('H:i:s'),
        ]);      
    }
}
