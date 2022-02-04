<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => '3HBC Admin',
            'email' => '3hbc.admin@test.com',
            'password' => 'password',
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => '3HBC Operations',
            'email' => '3hbc.operations@test.com',
            'password' => 'password',
        ]);

        $user->assignRole('operations');
    }
}
