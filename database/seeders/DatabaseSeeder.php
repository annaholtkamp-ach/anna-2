<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        \App\Models\Playdate::factory()->count(20)->create(); // generates 20 fake playdates //// User::factory(10)->create();
        \App\Models\event::factory()->count(20)->create();
        \App\Models\User::factory()->count(20)->create();
        \App\Models\host::factory()->count(20)->create();
        \App\Models\intention::factory()->count(20)->create();

    }
}
