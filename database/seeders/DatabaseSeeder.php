<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\HRSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Ahid Tech',
            'email' => 'ahidtechnologies@gmail.com',
            'password' => bcrypt('ahidtech')
        ]);

        if (app()->environment('local')) {
            $this->call([
                HRSeeder::class,
                WorkCheckSeeder::class
            ]);
        }
    }
}
