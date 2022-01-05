<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@sendiu.net',
            'password' => bcrypt('123456')
        ]);

        Client::factory()->create([
            'name' => 'Dariel',
            'lastname' => 'Abreu',
            'cardnumber' => '22400274092',
            'phonenumber' => '8294428902',
            'adrress' => 'Las Cobas',
            'city' => 'Santo Domingo',
            'email' => 'dariel@mail.com'
        ]);
    }
}
