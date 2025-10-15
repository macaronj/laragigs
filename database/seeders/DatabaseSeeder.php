<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        Listing::factory(5)->create([
            'user_id' => 1,
        ]);

        Listing::factory(5)->create([
            'user_id' => 2,
        ]);

        Listing::factory(5)->create([
            'user_id' => 3,
        ]);
    }
}
